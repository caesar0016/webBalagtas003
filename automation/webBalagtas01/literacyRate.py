import pandas as pd
from databaseConnection import *

tableName = "literacytable"

def literacyUpdate():
    try:
        df = pd.read_excel(literacyPath, sheet_name='Sheet1')
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("8. Literacy Inserted")
    except Exception as e:
        print("Error: {e}")
        
literacyUpdate()


