#!/usr/bin/python
from scapy.all import *

stars = lambda n: "*" * n

def GET_print(packet):
    return "\n".join((
        stars(40) + "GET PACKET" + stars(40),
        "\n".join(packet.sprintf("{Raw:%Raw.load%}").split(r"\r\n")),
        stars(90)))

sniff(
    iface='eth0',
    prn=GET_print,
    lfilter=lambda p: "GET" in str(p),
    filter="tcp port 443")
