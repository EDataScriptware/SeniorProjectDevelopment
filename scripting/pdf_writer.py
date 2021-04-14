from fpdf import FPDF 
import datetime
import sys, os
import data_retrievals
import sqlalchemy

now = datetime.datetime.now()
datetimeString = "Generated On: " + now.strftime("%B %m, %Y - %I:%M:%S %p")
pdfFileName = "../uploads/Mission_Report.pdf"

class PDF(FPDF):
   pass

pdf = PDF(orientation='p',unit='mm')
pdf.add_page()

def titles(self, string):
    self.set_xy(0.0,0.0)
    self.set_font('Times', 'B', 16)
    self.cell(w=210.0, h=40.0, align='C', txt=string)
    self.set_text_color(0, 0, 0)

def header(self, string):
    self.set_xy(5.0,0.0)
    self.set_font('Times', 'B', 14)
    self.cell(w=210.0, h=40.0, txt=string)
    self.set_text_color(0, 0, 0)

def subtitle(self, string):
    self.set_xy(0.0,245.0)
    self.set_font('Times', 'B', 14)
    self.set_text_color(0, 0, 0)
    self.cell(w=210.0, h=30.0, align='C', txt=string, border=0)

def logoImage(self, string):
    self.set_xy(80.0, 200.5)
    self.image(string, w=50.0, h=50.0, type='png')

def veteranNameList(self, string):
    self.set_xy(10.0,25.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=100.0, h=10.0, txt=string)
    self.set_text_color(0, 0, 0)

def borderLines(self):
    self.line(5.0,5.0,205.0,5.0)     # top one
    self.line(5.0,292.0,205.0,292.0) # bottom one
    self.line(5.0,5.0,5.0,292.0)     # left one
    self.line(205.0,5.0,205.0,292.0) # right one

borderLines(pdf)
titles(pdf, "Rochester Honor Flights Team Report")
logoImage(pdf, "TeamRuby.png")
subtitle(pdf, datetimeString)

## DATA PAGE


veteranNameArray = data_retrieval.getVeteranNames()
# veteranNameArray_sort = veteranNameArray[veteranNameArray[:,2].argsort()]

teamArray = []
counter=0
nameString = ""
for arrayVal in veteranNameArray:
    # print(arrayVal)
    counter += 1
    if str(arrayVal[3]) == "nan":
        pass
    elif arrayVal[3] in teamArray:
        pass
    else:
        teamArray.append(arrayVal[3])
for teamVal in teamArray:
    nameString = ""
    counter=0
    pdf.add_page(orientation='P')
    for arrayVal in veteranNameArray:
        # print(str(teamVal) + " " + str(arrayVal))
        header(pdf, "Team ID:" + str(int(teamVal)))
        if str(teamVal) == str(arrayVal[3]):
            counter += 1    
            nameString += str(counter) + " " + arrayVal[0] + " " + arrayVal[1] + " " + arrayVal[2] + "\n"
    veteranNameList(pdf, nameString)

veteranArray = data_retrieval.getAllVeteran()

pdf.add_page()
titles(pdf, "Rochester Honor Flight Individual Veteran Report")
subtitle(pdf, datetimeString)
logoImage(pdf, "TeamRuby.png")
borderLines(pdf)

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


for veteranRow in veteranArray:
    veteran_id              = veteranRow[0]
    guardian_id             = veteranRow[1]
    guardian_relation       = veteranRow[2]
    team_id                 = veteranRow[3]
    mission_id              = veteranRow[4]
    bus_id                  = veteranRow[5]
    first_name              = veteranRow[6]
    middle_initial          = veteranRow[7]
    last_name               = veteranRow[8]
    nickname                = veteranRow[9]
    gender                  = veteranRow[10]
    street                  = veteranRow[11]
    city                    = veteranRow[12]
    state                   = veteranRow[13]
    zipcode                 = veteranRow[14]
    email                   = veteranRow[15]
    day_phone               = veteranRow[16]
    cell_phone              = veteranRow[17]
    dateofbirth             = veteranRow[18]
    weight                  = veteranRow[19]
    how_heard               = veteranRow[20]
    shirt_size              = veteranRow[21]
    alt_name                = veteranRow[22]
    alt_phone               = veteranRow[23]
    alt_email               = veteranRow[24]
    alt_relationship        = veteranRow[25]
    emergency_name          = veteranRow[26]
    emergency_relationship  = veteranRow[27]
    emergency_address       = veteranRow[28]
    emergency_day_phone     = veteranRow[29]
    emergency_cell_phone    = veteranRow[30]
    service_branch          = veteranRow[31]
    service_rank            = veteranRow[32]
    service_years           = veteranRow[33]
    service_ww2             = veteranRow[34]
    service_korea           = veteranRow[35]
    service_cold_war        = veteranRow[36]
    service_vietnam         = veteranRow[37]
    service_activity        = veteranRow[38]
    med_cane                = veteranRow[39]
    med_walker              = veteranRow[40]
    med_wheelchair          = veteranRow[41]
    med_chair_loc           = veteranRow[42]
    med_scooter             = veteranRow[43]
    med_when_use            = veteranRow[44]
    med_list                = veteranRow[45]
    med_emphysema           = veteranRow[46]
    med_falls               = veteranRow[47]
    med_heart_disease       = veteranRow[48]
    med_pacemaker           = veteranRow[49]
    med_joint_replacement   = veteranRow[50]
    med_kidney              = veteranRow[51]
    med_diabetes            = veteranRow[52]
    med_seizures            = veteranRow[53]
    med_urostomy            = veteranRow[54]
    med_dimentia            = veteranRow[55]
    med_nebulizer           = veteranRow[56]
    med_oxygen              = veteranRow[57]
    med_football            = veteranRow[58]
    med_walk_bus_stops      = veteranRow[59]
    med_stroke              = veteranRow[60]
    med_urinary             = veteranRow[61]
    med_cpap                = veteranRow[62]
    med_flow_rate           = veteranRow[63]
    med_others              = veteranRow[64]
    med_use_mobility        = veteranRow[65]
    add_other_vets          = veteranRow[66]
    add_vet_names           = veteranRow[67]
    add_specific_guardian   = veteranRow[68]
    guardian_phone          = veteranRow[69]
    add_comments            = veteranRow[70]
    med_code                = veteranRow[71]
    app_date                = veteranRow[72]
    diet_restrictions       = veteranRow[73]
    admin_comments          = veteranRow[74]
    last_updated            = veteranRow[75]
    med_stairs              = veteranRow[76]
    med_stand_30min         = veteranRow[77]
    med_hbp                 = veteranRow[78]
    med_transport_airport   = veteranRow[79]
    med_transport_trip      = veteranRow[80]
    med_colostomy           = veteranRow[81]
    med_cancer              = veteranRow[82]
    med_dnr                 = veteranRow[83]
    additionalInformationArray = []
    additionalInformationArray.clear()

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

    additionalInformation = ""
    if additionalInformationArray.count != 0 and additionalInformationArray[0] != '':
        for additionalInformationItem in additionalInformationArray:
            if str(additionalInformationItem) != str(''):
                additionalInformation += "- " + additionalInformationItem + "\n"

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
        
    pdf.add_page()
    name(pdf, veteranName)
    address(pdf, contactInformation)
    categoryB(pdf, "Additional Information")
    additionalInformationPdf(pdf, additionalInformation)
    categoryA(pdf, "Guardian Information")
    guardianInformationPdf(pdf, guardianInformationString)
    

pdf.output(pdfFileName)
