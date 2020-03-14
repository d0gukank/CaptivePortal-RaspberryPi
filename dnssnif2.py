from scapy.all import *
import time

def querysniff(pkt):
    if IP in pkt:
         ip_src = pkt[IP].src
         ip_dst = pkt[IP].dst
    if UDP in pkt:
         udp_sport = pkt[UDP].sport
         udp_dport = pkt[UDP].dport
    if pkt.haslayer(DNS) and pkt.getlayer(DNS).qr == 0:
       print time.strftime("Time: %d/%m/%Y %H:%M:%S") + " DNS :" + str(ip_src) +":"+ str(udp_sport) +" -> " + str(ip_dst) + ":"+ str(udp_dport) + "  (" + pkt.getlayer(DNS).qd.qname + ")"

sniff(iface="wlp2s0", filter="port 53", prn=querysniff, store=0)
