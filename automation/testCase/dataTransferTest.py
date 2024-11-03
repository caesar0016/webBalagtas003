import unittest
from unittest.mock import patch, MagicMock
import pandas as pd
import logging

from foodThreshold import foodThresholdUpdate

class TestDataUpdate(unittest.TestCase):

    @patch('pandas.read_excel')
    @patch('foodThreshold.engine')  # Mock the database engine
    def testInsertDataSuccess(self, mock_engine, mock_read_excel):
        mock_df = MagicMock()
        mock_read_excel.return_value = mock_df
        
        with self.assertLogs(level='INFO') as log:  # Capture INFO logs
            foodThresholdUpdate('foodTresholdPath', engine=mock_engine)
        
        mock_read_excel.assert_called_once_with('foodTresholdPath', sheet_name='Sheet11')
        mock_df.to_sql.assert_called_once_with('foodThresholdTbl', mock_engine, if_exists='replace', index=False)
        
        # Check for the success message in the logs
        self.assertTrue(any("Success: Food Threshold Inserted" in message for message in log.output))

    @patch('pandas.read_excel')
    def testDataIfFailed(self, mock_read_excel):
        mock_read_excel.side_effect = FileNotFoundError("File not found")

        with self.assertLogs(level='ERROR') as log:
            foodThresholdUpdate('foodTresholdPath', engine=None)  # Call it with a mock engine or None

        # Check that the error message is in the log output
        self.assertTrue(any("Error: File not found" in message for message in log.output))

if __name__ == '__main__':
    unittest.main()
