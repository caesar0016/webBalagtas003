from databaseConnection import *
import pandas as pd

#table name which is the housing table
tableName = 'foodThresholdTbl'

def updateFoodThreshDB():
    try:
        df = pd.read_excel("Insert Path Here", sheet_name='RawData')
       # print(df)
        
        #df to sql with a parameter (Table Name, engine for database connection, if exist then replace, index false)
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("Food Threshold Inserted Successfully") #notif if the housing data was inserted
        
    except Exception as e: #fail safe mechanish incase something bad happens
        print(f"Error: {e}")

updateFoodThreshDB()