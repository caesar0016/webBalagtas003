import pandas as pd
from databaseConnection import *

tableName = "internetTable"

def internetUpdate():
    try:
        df = pd.read_excel(internetFilePath, sheet_name='Sheet1')
        
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("7. Internet Access Inserted")
        
    except Exception as e:
        print(f'Error: {e}')

internetUpdate()
        