from fpdf import FPDF 
import datetime
import sys, os
# import data_retrieval
# import sqlalchemy

# Python3 execution
#  python3 incident_writer.py '05/01/2021' '6000 Reynolds Dr.' '6:55 PM'  'Rochester, NY 14623' 'A murder happened.' 'Y' 'State Farms' 'Edward Riley' 'Veteran' 'University Commons Address Rochester, NY 14623' '05/01/1999' '(123) 456-7890' 'Zachary Easley' '(098) 654-4321' 'Justin Acroraci' '911'

dateIncident                = sys.argv[1]
addressIncident             = sys.argv[2]
timeIncident                = sys.argv[3]
extendedAddressIncident     = sys.argv[4]
detailedIncident            = sys.argv[5]
investigationFlagIncident   = sys.argv[6] # Y or N

if investigationFlagIncident.lower() == "y":
    investigationFlagIncident = True
else:
    investigationFlagIncident = False

agencyIncident              = sys.argv[7]

##########

nameReporter                = sys.argv[8]
typeReporter                = sys.argv[9] # Veteran, Guardian, or Volunteer
addressReporter             = sys.argv[10]
dobReporter                 = sys.argv[11]
phoneReporter               = sys.argv[12]
formWorker                  = sys.argv[13]
phoneWorker                 = sys.argv[14]
 
if typeReporter.lower() == "veteran":
    nameGuardian          = sys.argv[15]
    phoneGuardian         = sys.argv[16]


now = datetime.datetime.now()
datetimeString = "Generated On: " + now.strftime("%B %m, %Y - %I:%M:%S %p")
pdfFileName = "Incident_Report" + str(now.strftime("%Y-%m-%d")) + ".pdf"
print("starting pdf_writer.py")

class PDF(FPDF):
   pass

pdf = PDF(orientation='p',unit='mm')
pdf.add_page()

def titles(self, string):
    self.set_xy(15.0,0.0)
    self.set_font('Times', 'B', 16)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def dateOfIncidentPdf(self, string):
    self.set_xy(15.0,15.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def addressIncidentPdf(self, string):
    self.set_xy(70.0,15.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def timeIncidentPdf(self, string):
    self.set_xy(15.0,25.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def extendedAddressIncidentPdf(self, string):
    self.set_xy(71.0,25.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def subTitleDescribe(self, string):
    self.set_xy(15.0,35.0)
    self.set_font('Times', '', 13)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)


def detailedIncidentPdf(self, string):
    self.set_xy(15.0,45.0)
    self.set_font('Times', 'U', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

titles(pdf, "Incident Report")
dateOfIncidentPdf(pdf, "Date Of Incident:\t " + dateIncident)
addressIncidentPdf(pdf, "Address where incident occurred: " + addressIncident)
timeIncidentPdf(pdf, "Time of Incident: " + timeIncident)
extendedAddressIncidentPdf(pdf, "City, State, Zip: " + extendedAddressIncident)
subTitleDescribe(pdf, "Describe in detail the circumstances of the incident")
detailedIncidentPdf(pdf, detailedIncident)

def investigationFlagIncidentPdf(self, string):
    self.set_xy(15.0,65.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def agencyIncidentPdf(self, string):
    self.set_xy(15.0,75.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def nameReporterPdf(self, string):
    self.set_xy(15.0,85.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def typeReporterPdf(self, string):
    self.set_xy(70.0,85.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def AddressReporterPdf(self, string):
    self.set_xy(15.0,95.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)


def dobReporterPdf(self, string):
    self.set_xy(15.0,105.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def phoneReporterPdf(self, string):
    self.set_xy(70.0,105.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def GuardianNamePdf(self, string):
    self.set_xy(15.0,115.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)


def phoneGuardianPdf(self, string):
    self.set_xy(95.0,115.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def formWorkerPdf(self, string):
    self.set_xy(15.0,125.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)

def phoneWorkerPdf(self, string):
    self.set_xy(95.0,125.0)
    self.set_font('Times', '', 12)
    self.cell(w=210.0, h=40.0, align='L', txt=string)
    self.set_text_color(0, 0, 0)


if investigationFlagIncident == True:
    investigationFlagIncidentPdf(pdf, "Did the police investigate?\t  YES.")
else:
    investigationFlagIncidentPdf(pdf, "Did the police investigate?\t  NO.")

agencyIncidentPdf(pdf, "Police Agency: " + agencyIncident)
nameReporterPdf(pdf, "Name: " + nameReporter)
typeReporterPdf(pdf, "Type: " + typeReporter)
AddressReporterPdf(pdf, "Address: " + addressReporter)
dobReporterPdf(pdf, "Date of birth: " + dobReporter)
phoneReporterPdf(pdf, "Phone #: " + phoneReporter)
GuardianNamePdf(pdf, "If veteran - Guardian name: " + nameGuardian)
phoneGuardianPdf(pdf, "Phone #: " + phoneGuardian)
formWorkerPdf(pdf, "Person filling out form: " + formWorker)
phoneWorkerPdf(pdf, "Phone #: " + phoneWorker)

pdfFileName = "incident_report/Incident_Report_" + nameReporter + "_"+ str(now.strftime("%Y-%m-%d")) + ".pdf"
pdf.output(pdfFileName)
print("pdf_writer.py computed")