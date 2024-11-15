import pandas as pd
from databaseConnection import *

tableName = "ofwTable"

def ofwUpdate():
    try:
        
        df = pd.read_excel(ofwPath, sheet_name='RawData')
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("10. ofw inserted")
        
    except Exception as e:
        print(f'Error: {e}')
        