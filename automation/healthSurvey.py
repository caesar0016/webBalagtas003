from databaseConnection import *
import pandas as pd

#table name which is the housing table
tableName = 'housingtbl'

def healthSurveyUpdate():
    try:
        df = pd.read_excel(healthSurveyPath, sheet_name='Sheet1')
       # print(df)
        
        #df to sql with a parameter (Table Name, engine for database connection, if exist then replace, index false)
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        print("5. Health Survey Inserted") #notif if the housing data was inserted
        
    except Exception as e: #fail safe mechanish incase something bad happens
        print(f"Error: {e}")

healthSurveyUpdate()