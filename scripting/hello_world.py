try:
    print("HELLO WORLD!")
    from fpdf import FPDF 


    class PDF(FPDF):
        pass

    pdf = PDF(orientation='p',unit='mm')
    pdf.add_page()

    print("Printing outputting file")
    pdf.output("uploads/HelloWorld.pdf")
    print("HelloWorld.pdf printed")
except:
    print("ERROR")