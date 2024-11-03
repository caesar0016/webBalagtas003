import pandas as pd
from sqlalchemy import create_engine
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
from databaseConnection import * 
import time

# Database connection details
db_username = 'postgres'
db_password = 'Kuz18647'
db_host = 'localhost'
db_port = '5432'
db_name = 'prac001'
tableName = 'female_ratio'

connection_string = f'postgresql://{db_username}:{db_password}@{db_host}:{db_port}/{db_name}'
engine = create_engine(connection_string)

def updateDBFemale():

    try:
        # Load the specified sheet
        df = pd.read_excel(dapiton_populationPath, sheet_name='Sheet1', header=1)  # Update if the name is different
            
        df.insert(1, 'Gender', 'Female')  # Insert 'Gender' column
        
        n = 1
        df = df[1:-n]
        df.rename(columns={df.columns[0]: 'Barangay'}, inplace=True)

        #add all of the column 2 until 100
        sum_column = df.iloc[:, 2:100].sum(axis=1)
        
        #create a new column that have a named total
        df['Total'] = sum_column
        
        #if table exist it replaces otherwise it creates new
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Female Database Updated Sucess")
        
    except Exception as e:
        print(f"Error updating database: {e}")

