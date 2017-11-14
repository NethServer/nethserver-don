==============
nethserver-don
==============

NethServer configuration for Don: https://github.com/nethesis/windmill/tree/master/don.

How to configure
================

Before using, make sure to configure the following:

1. Configure remote server name and local system identification: ::
   
       config setprop don ServerName windmill.mydomain.org SystemId XXX-YYY
       signal-event nethserver-don-update

2. Copy your WindMill OpenVPN CA certificate inside ``/usr/share/don/ca.pem`` file,
   you can find it inside your WindMill server under ``/opt/windmill/easy-rsa/keys/ca.crt``.

3. Copy your WindMill support public key inside ``/usr/share/don/authorized_keys`` file,
   you can find it inside your WindMill server under ``/etc/keyholder.d/support.pub``.

Database
========

Properties

- ``ServerCa``: file path of the OpenVPN CA certificate
- ``ServerCertificateCn``: CN of the OpenVPN CA certificate, if set, enable CN verification
- ``ServerName``: public hostname of WindMill server
- ``SystemId``: custom string which identifies the machine


Example: ::

 don=configuration
    ServerCa=/usr/share/don/ca.pem
    ServerCertificateCn=C=test, name=windmill
    ServerName=windmill.mydomain.org
    SystemId=XXX-YYY
