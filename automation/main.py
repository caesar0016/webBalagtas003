import os
import time
import pandas as pd
from sqlalchemy import create_engine
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler

# Define PostgreSQL connection details directly in the script
DB_NAME = "webBalagtas02"
DB_USER = "postgres"
DB_PASSWORD = "Kuz18647"
DB_HOST = "localhost"
DB_PORT = "5432"

# Create the PostgreSQL connection string
connectionString = f"postgresql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"

# Create the SQLAlchemy engine using the connection string
engine = create_engine(connectionString)

# Function to import datasets into PostgreSQL
def import_datasets_to_postgres(folder_path):
    """
    This function imports all CSV and Excel datasets in the provided folder path into PostgreSQL.
    It creates tables based on the dataset's structure and inserts the data.
    """
    for filename in os.listdir(folder_path):
        file_path = os.path.join(folder_path, filename)

        # Skip directories
        if os.path.isdir(file_path):
            continue

        # Process CSV files
        if filename.endswith(".csv"):
            print(f"Processing CSV file: {filename}")
            df = pd.read_csv(file_path)
            table_name = os.path.splitext(filename)[0]
            df.to_sql(table_name, engine, if_exists='replace', index=False)
            print(f"Data from {filename} imported into table {table_name}.")

        # Process Excel files
        elif filename.endswith(".xlsx") or filename.endswith(".xls"):
            print(f"Processing Excel file: {filename}")
            df = pd.read_excel(file_path)
            table_name = os.path.splitext(filename)[0]
            df.to_sql(table_name, engine, if_exists='replace', index=False)
            print(f"Data from {filename} imported into table {table_name}.")
        else:
            print(f"Skipping unsupported file format: {filename}")

# Watchdog Event Handler for File Changes (CSV & Excel)
class ExcelCsvEventHandler(FileSystemEventHandler):
    def on_modified(self, event):
        # Only process if it's a file and either a CSV or Excel file
        if event.is_directory or not event.src_path.endswith(('.xlsx', '.csv')):
            return

        print(f"{event.src_path} has been modified. Waiting to update database...")
        time.sleep(5)  # Wait to ensure the file is fully written
        
        try:
            # Import the dataset based on the file extension
            if event.src_path.endswith('.xlsx') or event.src_path.endswith('.xls'):
                print(f"Processing modified Excel file: {event.src_path}")
                df = pd.read_excel(event.src_path)
                table_name = os.path.splitext(os.path.basename(event.src_path))[0]
                df.to_sql(table_name, engine, if_exists='replace', index=False)
                print(f"Data from {event.src_path} imported into table {table_name}.")
            elif event.src_path.endswith('.csv'):
                print(f"Processing modified CSV file: {event.src_path}")
                df = pd.read_csv(event.src_path)
                table_name = os.path.splitext(os.path.basename(event.src_path))[0]
                df.to_sql(table_name, engine, if_exists='replace', index=False)
                print(f"Data from {event.src_path} imported into table {table_name}.")
        except Exception as e:
            print(f"Failed to update database from {event.src_path}: {e}")

# Set up Watchdog to monitor the folder path
if __name__ == "__main__":
    folder_path = r"C:\Dataset"  # Adjust path to your folder (use raw string for Windows path)
    
    # Initially import all datasets in the folder
    print("Importing all datasets from the folder...")
    import_datasets_to_postgres(folder_path)
    
    # Set up the observer for real-time monitoring of the folder
    event_handler = ExcelCsvEventHandler()
    observer = Observer()
    observer.schedule(event_handler, folder_path, recursive=False)
    
    try:
        print("Starting to monitor the folder for changes...")
        observer.start()
        while True:
            time.sleep(1)  # Keep the program running and observing for file changes
    except KeyboardInterrupt:
        observer.stop()
        print("Monitoring stopped.")
    observer.join()
