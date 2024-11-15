from databaseConnection import *
import logging
import pandas as pd

# Configure logging at the start of your module
logging.basicConfig(level=logging.INFO)

# Table name
tableName = 'foodThresholdTbl'

def foodThresholdUpdate(foodTresholdPath, engine):
    try:
        df = pd.read_excel(foodTresholdPath, sheet_name='Sheet1')
        df.to_sql(tableName, engine, if_exists='replace', index=False)
        logging.info("Success: Food Threshold Inserted")  # Log success
    except Exception as e:
        logging.error(f"Error: {e}")


foodThresholdUpdate(foodTresholdPath, engine)