# Bellatrix

Bellatrix is a port/rewrite borrowing from the REST request/resource architecture which evolved under AblePolecat but w/o 
alot of the ESB fluff. It is written mainly to address specific business needs here at Kuhrman Technology Solutions LLC 
but it is released under GPL 3 as free software with the hope that it may eventually help others and in turn their changes 
will benefit the free software community at large.

# Goals

Bellatrix is a web application in the sense that it runs on a web server (ideally Apache) and the user interface is a web browser. 
But its main purpose is to integrate the web interface with other business information systems. Among the envisoined business 
applications Bellatrix will be designed to exchange data with are:
1. LibreCAD
2. GNU Electric and/or KiCAD (ECAD)
3. LibreOffice Writer
4. MySql database
5. Drupal CMS (by way of Drupal custom module(s))
6. Google API (mainly Google+ for OAuth "sign in with...")
7. LinkedIn API (again, mainly for OAuth "sign in with...")
8. Twitter (again, mainly for OAuth "sign in with...")

The business needs surrounding these envisoined integrations are at present:
1. Synchronize project information across CAD drawings, ECAD schematics and layouts, data sheets and technical specifications
2. Synchronize Bill of Materials with Enterprise Resource Planning (ERP)
3. Synchronize Case Management (Customer Web Portal) with CRM
4. Synchronize project resource server with web community, forums etc (CMS)
5. Allow users restricted access to online resources w/o need to set up separate account (use Google, LinkedIn, etc to validate)
