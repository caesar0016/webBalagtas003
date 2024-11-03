import pandas as pd
from databaseConnection import *

tableName = "pwdTable"

def pwdUpdate():
    try:
        df = pd.read_excel(pwdPath, sheet_name='Sheet1')
        # print(df)
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("10. pwd inserted")
    except Exception as e:
        print(f'Error: {e}')
        
pwdUpdate()