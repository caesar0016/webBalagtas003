import pandas as pd
from databaseConnection import *

tableName = 'populationtbl'

def populationUpdate():
    try:
        # Read the Excel file into a DataFrame
        df = pd.read_excel(populationPath, sheet_name='Sheet1')
        
        # Insert the DataFrame into the database
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("12. PopulationData inserted")
        # print(df)
        
    except Exception as e:
        print(f"Error updating database: {e}")

# Call the function to update the population data
populationUpdate()
