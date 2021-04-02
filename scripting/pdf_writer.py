from fpdf import FPDF 
import datetime
import sys, os
import data_retrieval
import sqlalchemy

now = datetime.datetime.now()
datetimeString = "Generated On: " + now.strftime("%B %m, %Y - %I:%M:%S %p")
pdfFileName = "Report_" + now.strftime("%B%m%Y_%H%M%S") + ".pdf"

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

for veteranRow in veteranArray:
    veteran_id          = veteranRow[0]
    guardian_id         = veteranRow[1]
    guardian_relation   = veteranRow[2]
    team_id             = veteranRow[3]
    mission_id          = veteranRow[4]
    bus_id              = veteranRow[5]
    first_name          = veteranRow[6]
    middle_initial      = veteranRow[7]
    last_name           = veteranRow[8]
    nickname            = veteranRow[9]
    gender              = veteranRow[10]
    street              = veteranRow[11]
    city                = veteranRow[12]
    state               = veteranRow[13]
    zipcode             = veteranRow[14]
    email               = veteranRow[15]
    day_phone           = veteranRow[16]
    cell_phone          = veteranRow[17]
    dateofbirth         = veteranRow[18]
    weight              = veteranRow[19]
    how_heard           = veteranRow[20]
    shirt_size          = veteranRow[21]
    alt_name            = veteranRow[22]
    alt_phone           = veteranRow[23]
    alt_email           = veteranRow[24]
    alt_relationship    = veteranRow[25]
    emergency_name          = veteranRow[26]
    emergency_relationship  = veteranRow[27]
    emergency_address       = veteranRow[28]
    emergency_day_phone     = veteranRow[29]
    emergency_cell_phone    = veteranRow[30]
    service_branch      = veteranRow[31]
    service_rank        = veteranRow[32]
    service_years       = veteranRow[33]
    service_korea       = veteranRow[34]
    service_cold_war    = veteranRow[35]
    service_vietnam     = veteranRow[36]
    service_activity    = veteranRow[37]
    med_cane            = veteranRow[38]
    med_walker          = veteranRow[39]
    med_wheelchair      = veteranRow[40]
    med_chair_loc       = veteranRow[41]
    med_scooter         = veteranRow[42]
    med_when_use        = veteranRow[43]
    med_list            = veteranRow[44]
    med_emphysema       = veteranRow[45]
    med_falls           = veteranRow[46]
    med_heart_disease   = veteranRow[47]
    med_pacemaker       = veteranRow[48]
    med_joint_replace   = veteranRow[49]
    med_kidney          = veteranRow[50]
    med_diabetes        = veteranRow[51]
    med_seizures        = veteranRow[52]
    med_urostomy        = veteranRow[53]
    med_dimentia        = veteranRow[54]
    med_nebulizer       = veteranRow[55]
    med_oxygen          = veteranRow[56]
    med_football        = veteranRow[57]
    med_walk_bus_stops  = veteranRow[58]
    med_stroke          = veteranRow[59]
    med_urinary         = veteranRow[60]
    med_cpap            = veteranRow[61]
    med_flow_rate       = veteranRow[62]
    med_others          = veteranRow[63]
    med_use_mobility    = veteranRow[64]
    add_other_vets      = veteranRow[65]
    add_vet_names       = veteranRow[66]
    add_specific_guardian   = veteranRow[67]
    guardian_phone      = veteranRow[68]
    add_comments        = veteranRow[69]
    med_stairs          = veteranRow[70]
    med_stand_30min     = veteranRow[71]
    med_hbp             = veteranRow[72]
    med_transport_airport   = veteranRow[73]
    med_transport_trip  = veteranRow[74]
    med_colostomy       = veteranRow[75]
    med_cancer          = veteranRow[76]
    med_dnr             = veteranRow[77]


    veteranName = first_name + " " + '"' + str(nickname) + '"' + " " + middle_initial + " " + last_name
    contactInformation = str(street) + "\n" + str(city) + ", " + str(state) + "\n" + str(zipcode + "\nHome Phone: " + str(day_phone) + "\nCell Phone: " + str(cell_phone) + "\nDate Of Birth: " + str(dateofbirth) + "\nGender: " + str(gender) + "\nWeight: " + str(weight) + " lbs.")



    pdf.add_page()
    name(pdf, veteranName)
    address(pdf, contactInformation)
    categoryA(pdf, "Guardian Information")


pdfFileName = "test.pdf"
pdf.output(pdfFileName)