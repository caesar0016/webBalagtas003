import pandas as pd
from databaseConnection import *

tableName = "literacytable"

def updateLiteracyDB():
    try:
        df = pd.read_excel(literacyPath, sheet_name='Sheet1')
        # print(df)
        
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Insert Success Literacy to Database")
    except Exception as e:
        print("Error: {e}")
        
updateLiteracyDB()