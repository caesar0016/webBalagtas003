import pandas as pd
from databaseConnection import *

tableName = "internetTable"

def updateInternetDB():
    try:
        df = pd.read_excel(internetFilePath, sheet_name='Sheet1')
        
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Success insert for internet to database")
        
    except Exception as e:
        print(f'Error: {e}')
        