import pandas as pd # for data cleaning
from databaseConnection import *

tableName = 'female_tblratio'

def femaleRatioUpdate():

    try:
        # Load the specified sheet
        df = pd.read_excel(populationPath, sheet_name='Sheet1', header=1)  # Update if the name is different
            
        df.insert(1, 'Gender', 'Female')  # Insert 'Gender' column
        
        n = 1
        df = df[1:-n]
        df.rename(columns={df.columns[0]: 'Barangay'}, inplace=True)

        #add all of the column 2 until 100
        sum_column = df.iloc[:, 2:100].sum(axis=1)
        
        #create a new column that have a named total
        df['Total'] = sum_column
        
        #if table exist it replaces otherwise it creates new
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("13. Female Database Updated Sucess")
        
    except Exception as e:
        print(f"Error updating database: {e}")

femaleRatioUpdate()
