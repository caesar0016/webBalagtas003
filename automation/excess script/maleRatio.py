import pandas as pd # for data cleaning
from databaseConnection import *

tableName = 'male_ratio'

def dataCleaningMaleRatio():
    
    try:
        # Load the specified sheet
        df = pd.read_excel(populationPath, sheet_name='Sheet1', header=1)  # Update if the name is different
        
        # df = df.drop(df.columns[1:100], axis=1)

        # df.rename(columns={df.columns[0]: 'Barangay'}, inplace=True) #renaming the column zero into barangay
        

        #if table exist it replaces otherwise it creates new
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Male Ratio Inserted")
        
        
    except Exception as e:
        print(f"Error updating database: {e}")

# Call the function
dataCleaningMaleRatio()