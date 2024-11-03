from watchdog.observers import Observer
import time
from watchdog.events import FileSystemEventHandler

from povertyHousehold import *
from dohPoints import *
from foodThreshold import *
from healthSurvey import *
from housingScript import *
from internetAccess import *
from literacyRate import *
from migration import *
from ofwScript import *
from pwdScript import *
from totalPopulationScript import *

def updateAll():
    try:
        #this is the list of insert
        povertyTblUpdate()
        dohPointsUpdate()
        foodThresholdUpdate()
        healthSurveyUpdate()
        housingUpdate()
        internetUpdate()
        literacyUpdate()
        migrationUpdate()
        ofwUpdate()
        pwdUpdate()
        populationUpdate()
        
        print("All File Done inserting")
        
    except Exception as e:
        print(f'Error: {e}')
        
#update all when run
updateAll()

# Set up the event handler
class ExcelEventHandler(FileSystemEventHandler):
    def on_modified(self, event):
        if event.is_directory or not event.src_path.endswith('.xlsx'):
            return
        
        print(f"{event.src_path} has been modified. Waiting to update database...")
        time.sleep(5)  # Wait to ensure file is fully written
        
        try:
            updateAll()
            print(f"Database updated successfully for {event.src_path}.")
        except Exception as e:
            print(f"Failed to update database: {e}")

# Setup the observer
if __name__ == "__main__":
    event_handler = ExcelEventHandler()
    observer = Observer()
    observer.schedule(event_handler, datasetPath, recursive=False)
    observer.start()

    try:
        while True:
            time.sleep(1)  # Keep the script running
    except KeyboardInterrupt:
        observer.stop()
    observer.join()