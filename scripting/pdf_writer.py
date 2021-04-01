from fpdf import FPDF 
import datetime
import sys, os
import data_retrieval
import sqlalchemy

now = datetime.datetime.now()
generatedString = "Generated On: " + now.strftime("%B %m, %Y - %I:%M:%S %p")
pdfFileName = "Report_" + now.strftime("%B%m%Y_%H%M%S") + ".pdf"

class PDF(FPDF):
   pass

pdf = PDF(orientation='p',unit='mm')
pdf.add_page()

def titles(self):
    self.set_xy(0.0,0.0)
    self.set_font('Times', 'B', 16)
    self.cell(w=210.0, h=40.0, align='C', txt="Rochester Honor Flights Report")
    self.set_text_color(0, 0, 0)

def subtitle(self):
    self.set_xy(0.0,245.0)
    self.set_font('Times', 'B', 16)
    self.set_text_color(0, 0, 0)
    self.cell(w=210.0, h=30.0, align='C', txt=generatedString, border=0)

def logoImage(self):
    self.set_xy(80.0, 200.5)
    self.image("TeamRuby.png", w=50.0, h=50.0, type='png')

pdf.line(5.0,5.0,205.0,5.0) # top one
pdf.line(5.0,292.0,205.0,292.0) # bottom one
pdf.line(5.0,5.0,5.0,292.0) # left one
pdf.line(205.0,5.0,205.0,292.0) # right one

titles(pdf)
logoImage(pdf)
subtitle(pdf)

veteranNameArray = data_retrieval.getVeteranNames()
counter=0
nameString = ""
for arrayVal in veteranNameArray:
    counter += 1
    nameString += str(counter) + " " + arrayVal[0] + " " + arrayVal[1] + " " + arrayVal[2] + "\n"

## DATA PAGE
def veteranNameList(self, string) :
    self.set_xy(5.0,0.0)
    self.set_font('Times', 'B', 12)
    self.multi_cell(w=100.0, h=15.0, txt=string)
    self.set_text_color(0, 0, 0)

pdf.add_page(orientation='P')
veteranNameList(pdf, nameString)

pdfFileName = "test.pdf"
pdf.output(pdfFileName)