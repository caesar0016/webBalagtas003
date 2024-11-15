from sqlalchemy import create_engine
from sqlalchemy.exc import SQLAlchemyError

# Database connection details
db_username = 'postgres'
db_password = 'Kuz18647'
db_host = 'localhost'
db_port = '5432'
db_name = 'webBalagtas01' #The database for direct qeury is webBalagtas02

connectionString = f'postgresql://{db_username}:{db_password}@{db_host}:{db_port}/{db_name}'
engine = create_engine(connectionString)


#balagtas Area  file path
areaBalagtasPath = 'C:/Dataset/balagtasArea.xlsx'

#balagtasPovertyTreshold file path
povertyPath = 'C:/Dataset/balagtasPovertyTreshold.xlsx'

#dohWithPoints file path
healthFacilityPath = 'C:/Dataset/dohWithPoints.xlsx'

#foodTreshold  file path
foodTresholdPath = 'C:/Dataset/foodTreshold.xlsx'

#healthSurvey  file path
healthSurveyPath = 'C:/Dataset/healthSurvey.xlsx'

# pwd ron path
pwdPath = 'C:/Dataset/pwd.xlsx'

# #dapiton path
housingPath = 'C:/Dataset/housing category and household size.xlsx'

# ofw ron path
ofwPath = 'C:/Dataset/ofw.xlsx'

# Literacy Rate ron path
literacyPath = 'C:/Dataset/literacy.xlsx'

# internet Accesss ron path
internetFilePath = 'C:/Dataset/internet access.xlsx'

# migration ron path
migrationPath = 'C:/Dataset/migration.xlsx'

# populationPath
populationPath = 'C:/Dataset/total population by age and by sex.xlsx'

# ron file path for dataset
datasetPath = 'C:/Dataset'