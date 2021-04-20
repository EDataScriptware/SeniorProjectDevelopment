from fpdf import FPDF 
import datetime
import sys, os
import data_retrieval
import sqlalchemy

now = datetime.datetime.now()
datetimeString = "Generated On: " + now.strftime("%B %m, %Y - %I:%M:%S %p")
pdfFileName = "IndividualReport_" + str(now.strftime("%Y-%m-%d")) + ".pdf"
print("starting single_writer.py")
passedVeteranNumber = sys.argv[1]
class PDF(FPDF):
   pass

pdf = PDF(orientation='p',unit='mm')
pdf.add_page()



def name(self, string):
    self.set_xy(15.0,15.0)
    self.set_font('Times', 'B', 12)
    self.cell(w=210.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

def address(self, string):
    self.set_xy(15.0,20.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=210.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

def categoryA(self, string):
    self.set_xy(15.0,65.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=210.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

def categoryB(self, string):
    self.set_xy(85.0,65.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=210.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

def additionalInformationPdf(self, string):
    self.set_xy(85.0,70.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=210.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

def guardianInformationPdf(self, string):
    self.set_xy(15.0,70.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=75.0, h=5.0, txt=string)
    self.set_text_color(0, 0, 0)

veteranNameArray = data_retrieval.getSpecificVeteran(passedVeteranNumber)
additionalInformationArray = []

for veteranNameArray in veteranNameArray:
    veteran_id              = veteranNameArray[0]
    guardian_id             = veteranNameArray[1]
    guardian_relation       = veteranNameArray[2]
    team_id                 = veteranNameArray[3]
    mission_id              = veteranNameArray[4]
    bus_id                  = veteranNameArray[5]
    first_name              = veteranNameArray[6]
    middle_initial          = veteranNameArray[7]
    last_name               = veteranNameArray[8]
    nickname                = veteranNameArray[9]
    gender                  = veteranNameArray[10]
    street                  = veteranNameArray[11]
    city                    = veteranNameArray[12]
    state                   = veteranNameArray[13]
    zipcode                 = veteranNameArray[14]
    email                   = veteranNameArray[15]
    day_phone               = veteranNameArray[16]
    cell_phone              = veteranNameArray[17]
    dateofbirth             = veteranNameArray[18]
    weight                  = veteranNameArray[19]
    how_heard               = veteranNameArray[20]
    shirt_size              = veteranNameArray[21]
    alt_name                = veteranNameArray[22]
    alt_phone               = veteranNameArray[23]
    alt_email               = veteranNameArray[24]
    alt_relationship        = veteranNameArray[25]
    emergency_name          = veteranNameArray[26]
    emergency_relationship  = veteranNameArray[27]
    emergency_address       = veteranNameArray[28]
    emergency_day_phone     = veteranNameArray[29]
    emergency_cell_phone    = veteranNameArray[30]
    service_branch          = veteranNameArray[31]
    service_rank            = veteranNameArray[32]
    service_years           = veteranNameArray[33]
    service_ww2             = veteranNameArray[34]
    service_korea           = veteranNameArray[35]
    service_cold_war        = veteranNameArray[36]
    service_vietnam         = veteranNameArray[37]
    service_activity        = veteranNameArray[38]
    med_cane                = veteranNameArray[39]
    med_walker              = veteranNameArray[40]
    med_wheelchair          = veteranNameArray[41]
    med_chair_loc           = veteranNameArray[42]
    med_scooter             = veteranNameArray[43]
    med_when_use            = veteranNameArray[44]
    med_list                = veteranNameArray[45]
    med_emphysema           = veteranNameArray[46]
    med_falls               = veteranNameArray[47]
    med_heart_disease       = veteranNameArray[48]
    med_pacemaker           = veteranNameArray[49]
    med_joint_replacement   = veteranNameArray[50]
    med_kidney              = veteranNameArray[51]
    med_diabetes            = veteranNameArray[52]
    med_seizures            = veteranNameArray[53]
    med_urostomy            = veteranNameArray[54]
    med_dimentia            = veteranNameArray[55]
    med_nebulizer           = veteranNameArray[56]
    med_oxygen              = veteranNameArray[57]
    med_football            = veteranNameArray[58]
    med_walk_bus_stops      = veteranNameArray[59]
    med_stroke              = veteranNameArray[60]
    med_urinary             = veteranNameArray[61]
    med_cpap                = veteranNameArray[62]
    med_flow_rate           = veteranNameArray[63]
    med_others              = veteranNameArray[64]
    med_use_mobility        = veteranNameArray[65]
    add_other_vets          = veteranNameArray[66]
    add_vet_names           = veteranNameArray[67]
    add_specific_guardian   = veteranNameArray[68]
    guardian_phone          = veteranNameArray[69]
    add_comments            = veteranNameArray[70]
    med_code                = veteranNameArray[71]
    app_date                = veteranNameArray[72]
    diet_restrictions       = veteranNameArray[73]
    admin_comments          = veteranNameArray[74]
    last_updated            = veteranNameArray[75]
    med_stairs              = veteranNameArray[76]
    med_stand_30min         = veteranNameArray[77]
    med_hbp                 = veteranNameArray[78]
    med_transport_airport   = veteranNameArray[79]
    med_transport_trip      = veteranNameArray[80]
    med_colostomy           = veteranNameArray[81]
    med_cancer              = veteranNameArray[82]
    med_dnr                 = veteranNameArray[83]


if str(med_walker) == str("1"):
    additionalInformationArray.append("Uses a walker.")
if str(med_wheelchair) == str("1"):
    additionalInformationArray.append("Uses a wheelchair - located at " + str(med_chair_loc) + ".") 
if str(med_scooter) == str("1"): 
    additionalInformationArray.append("Uses a scooter.")
if str(med_emphysema) == str("1"):
    additionalInformationArray.append("Has emphysema.")
if str(med_falls) == str("1"):
    additionalInformationArray.append("Prone to falling.")
if str(med_heart_disease) == str("1"):
    additionalInformationArray.append("Has a heart disease.")
if str(med_pacemaker) == str("1"):
    additionalInformationArray.append("Has a pacemaker.")
if str(med_joint_replacement) == str("1"):
    additionalInformationArray.append("Has a joint replacement.")
if str(med_kidney) == str("1"):
    additionalInformationArray.append("Has a kidney issue.")
if str(med_diabetes) == str("1"):
    additionalInformationArray.append("Has diabetes.")
if str(med_seizures) == str("1"):
    additionalInformationArray.append("Prone to seizures.")
if str(med_nebulizer) == str("1"):
    additionalInformationArray.append("Has a nebulizer.")
if str(med_urostomy) == str("1"):
    additionalInformationArray.append("Has a urostomy.")
if str(med_oxygen) == str("1"):
    additionalInformationArray.append("Has an oxygen tank.")
if str(med_pacemaker) == str("1"):
    additionalInformationArray.append("Has a football.")
if str(med_walk_bus_stops) == str("1"):
    additionalInformationArray.append("Can walk on bus steps.")
if str(med_stroke) == str("1"):
    additionalInformationArray.append("Prone to strokes.")
if str(med_urinary) == str("1"):
    additionalInformationArray.append("Has bladder problems.")
if str(med_cpap) == str("1"):
    additionalInformationArray.append("Has a CPAP machine.")
if str(med_use_mobility) == str("1"):
    additionalInformationArray.append("Has good mobility.")
if str(add_other_vets) == str("1"):
    additionalInformationArray.append("Other veterans are with this veteran.")
if str(diet_restrictions) == str("1"):
    additionalInformationArray.append("Has diet restrictions.")
if str(med_stairs) == str("1"):
    additionalInformationArray.append("Can use stairs.")
if str(med_stand_30min) == str("1"):
    additionalInformationArray.append("Can stand for approximately 30 minutes.")
if str(med_hbp) == str("1"):
    additionalInformationArray.append("Has high blood pressure.")
if str(med_transport_airport) == str("1"):
    additionalInformationArray.append("Can transport to the airport.")
if str(med_transport_trip) == str("1"):
    additionalInformationArray.append("Can transport on the trip.")
if str(med_colostomy) == str("1"):
    additionalInformationArray.append("Has colostomy.")
if str(med_cancer) == str("1"):
    additionalInformationArray.append("Has cancer.")
if str(med_dnr) == str("1"):
    additionalInformationArray.append("Has a Do-Not-Resuscitate order")
additionalInformationArray.append(med_others)

veteranName = first_name + " " + '"' + str(nickname) + '"' + " " + middle_initial + " " + last_name
contactInformation = str(street) + "\n" + str(city) + ", " + str(state) + "\n" + str(zipcode + "\nHome Phone: " + str(day_phone) + "\nCell Phone: " + str(cell_phone) + "\nDate Of Birth: " + str(dateofbirth) + "\nGender: " + str(gender) + "\nWeight: " + str(weight) + " lbs.")

if str(guardian_id) != str("nan"):
    guardianInformationArray = data_retrieval.matchGuardianAndVet(guardian_id)
    for guardianInformationItem in guardianInformationArray:
        print(guardianInformationArray)
        guardian_firstname          = guardianInformationItem[0]
        guardian_middleinitial      = guardianInformationItem[1]
        guardian_lastname           = guardianInformationItem[2]
        guardian_address            = guardianInformationItem[3]
        guardian_city               = guardianInformationItem[4]
        guardian_state              = guardianInformationItem[5]
        guardian_zip                = guardianInformationItem[6]
        guardian_nickname           = guardianInformationItem[7]
        guardian_dayphone           = guardianInformationItem[8]
        guardian_cellphone          = guardianInformationItem[9]


        guardianNameString = str(guardian_relation) + " : " + str(guardian_firstname) + " " + str(guardian_nickname) + " " + str(guardian_middleinitial) + " " + str(guardian_lastname) + "\n"
        guardianAddressString = str(guardian_address) + ",\n" + str(guardian_city) + " " + str(guardian_state) + ",\n" + str(guardian_zip) + "\n"
        guardianPhoneString = "Home Phone: " + str(guardian_dayphone) + "\nCell Phone: " + str(guardian_dayphone)
        guardianInformationString = guardianNameString + guardianAddressString + guardianPhoneString
else:
    guardianInformationString = "No guardian."

additionalInformation = ""
if additionalInformationArray.count != 0 and additionalInformationArray[0] != '':
    for additionalInformationItem in additionalInformationArray:
        if str(additionalInformationItem) != str(''):
            additionalInformation += "- " + additionalInformationItem + "\n"


name(pdf, veteranName)
address(pdf, contactInformation)
categoryB(pdf, "Additional Information")
additionalInformationPdf(pdf, additionalInformation)
categoryA(pdf, "Guardian Information")
guardianInformationPdf(pdf, guardianInformationString)


pdf.output(pdfFileName)
print("pdf_writer.py computed")