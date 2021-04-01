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

pdf.line(5.0,5.0,205.0,5.0)     # top one
pdf.line(5.0,292.0,205.0,292.0) # bottom one
pdf.line(5.0,5.0,5.0,292.0)     # left one
pdf.line(205.0,5.0,205.0,292.0) # right one

titles(pdf, "Rochester Honor Flights Report")
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




pdfFileName = "test.pdf"
pdf.output(pdfFileName)