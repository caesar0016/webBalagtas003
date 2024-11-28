from sqlalchemy import create_engine
from dotenv import load_dotenv
import os

# Load environment variables from the .env file
load_dotenv('credentials.env')

# Retrieve the database URL from the environment variable
connectionString = os.getenv('DATABASE_URL')

# Check if the environment variable was loaded correctly
if connectionString:
    print("Environment variable loaded successfully.")
else:
    print("Error: DATABASE_URL environment variable not found.")

# Create the SQLAlchemy engine using the connection string
engine = create_engine(connectionString)

# Test the connection to the database
try:
    with engine.connect() as connection:
        print("Connection to the database was successful!")
except Exception as e:
    print(os.getenv('DATABASE_URL'))
    print(f"Error: {e}")

# This line is just for testing and will be printed regardless of the connection outcome
print("Hello World")
