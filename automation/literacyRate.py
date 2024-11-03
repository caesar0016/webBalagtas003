import pandas as pd
from databaseConnection import *

tableName = "literacytable"

def literacyUpdate():
    try:
        df = pd.read_excel(literacyPath, sheet_name='Sheet1')
        # print(df)
        
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("7. Literacy Inserted")
    except Exception as e:
        print("Error: {e}")
        
literacyUpdate()