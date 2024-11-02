import pandas as pd # for data cleaning
from databaseConnection import *

tableName = 'male_ratio'

def dataCleaningMaleRatio():
    
    try:
        # Load the specified sheet
        df = pd.read_excel(dapiton_populationPath, sheet_name='Sheet1', header=0)  # Update if the name is different
        
        df = df.drop(df.columns[1:100], axis=1)
        
        num1 = len(df.columns)
        df.columns = df.iloc[0]  # Set the first row as the header
        df = df[1:]  # Remove the first row from the DataFrame

        df.rename(columns={df.columns[0]: 'Barangay'}, inplace=True) #renaming the column zero into barangay
        
        df = df.iloc[1:-1] #removes the first row and last row of the data frame
        df = df.iloc[:, :-1] #removes the last column of the data frame
        df.insert(1, 'Gender', 'Male')  # Insert 'Gender' column
        # df.reset_index(inplace=True)
        
        #add all of the column 2 until 100
        sum_column = df.iloc[:, 2:100].sum(axis=1)
        
        #create a new column that have a named total
        df['Total'] = sum_column
        
        # print(df)
        # df.to_excel(output_file_path, index=False)  # Exports without the index
        
        print("Data cleaned and exported successfully.")

        #if table exist it replaces otherwise it creates new
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Data Frame inserted Successfully")
        
        
    except Exception as e:
        print(f"Error updating database: {e}")

# Call the function
dataCleaningMaleRatio()