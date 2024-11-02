from sqlalchemy import create_engine
from sqlalchemy.exc import SQLAlchemyError

# Database connection details
db_username = 'postgres'
db_password = 'Kuz18647'
db_host = 'localhost'
db_port = '5432'
db_name = 'prac001'

connectionString = f'postgresql://{db_username}:{db_password}@{db_host}:{db_port}/{db_name}'
engine = create_engine(connectionString)

#dapiton's file path
populationPath = 'C:/Users/dapit/Documents/Dataset/total population by age and by sex.xlsx'


#dapiton file path for dataset
datasetPath = 'C:/Users/dapit/Documents/Dataset/'

#dapiton path
housingPath = 'C:/Users/dapit/Documents/Dataset/housing category and household size.xlsx'

#dapiton ron path
migrationPath = 'C:/Users/dapit/Documents/Dataset/migration.xlsx'

#internet Accesss dapiton path
internetFilePath = 'C:/Users/dapit/Documents/Dataset/internet access.xlsx'

#Literacy Rate dapiton path
literacyPath = 'C:/Users/dapit/Documents/Dataset/literacy rate by sex.xlsx'

#ofw dapiton path
ofwPath = 'C:/Users/dapit/Documents/Dataset/ofw.xlsx'


#pwd dapiton path
pwdPath = 'C:/Users/dapit/Documents/Dataset/pwd.xlsx'

#////---------------------- Ron Path --------------------------------------

#pwd ron path
# pwdPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/pwd.xlsx'


#ofw ron path
# ofwPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/ofw.xlsx'

#Literacy Rate ron path
# literacyPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/literacy rate by sex.xlsx'

#internet Accesss ron path
# internetFilePath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/internet access.xlsx'


#migration ron path
#migrationPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/migration.xlsx'

#housing ron path
#ron file path
#populationPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal/total population by age and by sex.xlsx'

#ron file path for dataset
#datasetPath = 'C:/Users/RonJillMai3/Music/Dataset Municipal'