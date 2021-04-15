try:
    print("HELLO WORLD!")
    from fpdf import FPDF 

    print("AM I BEING TRIGGERED #1?")
    class PDF(FPDF):
        pass

    print("AM I BEING TRIGGERED #2?")
    pdf = PDF(orientation='p',unit='mm')
    pdf.add_page()
    
    print("Printing outputting file")
    
    pdf.output("uploads/HelloWorld.pdf")
    
    print("HelloWorld.pdf printed")
except:
    print("ERROR")