import pandas as pd
from databaseConnection import *

tableName = "literacytable"

def literacyUpdate():
    try:
        df = pd.read_excel(literacyPath, sheet_name='Sheet1', header=2)
        # print(df)
        
         # Add a new column 'no' by summing 'Unnamed: 1' and 'Unnamed: 2'
        # Ensure the columns 'Unnamed: 1' and 'Unnamed: 2' are numeric before summing
        df['No'] = df['Unnamed: 1'].astype(int) + df['Unnamed: 2'].astype(int)
        df['Yes'] = df['Unnamed: 3'].astype(int) + df['Unnamed: 4'].astype(int)
        df['Blank'] = df['Unnamed: 5'].astype(int) + df['Unnamed: 6'].astype(int)
        
        # print(df[['BARANGAY', 'Yes', 'No', 'Blank']])
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("8. Literacy Inserted")
    except Exception as e:
        print("Error: {e}")
        
literacyUpdate()


