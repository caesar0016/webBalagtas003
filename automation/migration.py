from databaseConnection import *
import pandas as pd

tableName = 'migrationtable'
    
def migrationUpdate():
    try:
        df = pd.read_excel(migrationPath, sheet_name='RawData')
        
        #print(df)
        
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        
        print("9. Migration Inserted")
        
    except Exception as e:
        print(f'Error: {e}')
    