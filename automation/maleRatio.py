import pandas as pd # for data cleaning
from databaseConnection import *

tableName = 'male_ratio'

def maleRatioUpdate():

    try:
        # Load the specified sheet
        df = pd.read_excel(populationPath, sheet_name='Sheet1')  # Update if the name is different
        
        df = df.drop(df.columns[1:100], axis=1)
        
        df.insert(1, 'Gender', 'Male')  # Insert 'Gender' column
        
        # df = df.drop('1', axis=1)  # This drops the column named '0'

       
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("13. Male Database Updated Sucess")
        
    except Exception as e:
        print(f"Error updating database: {e}")

maleRatioUpdate()
