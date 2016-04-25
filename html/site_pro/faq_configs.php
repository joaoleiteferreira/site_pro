<!DOCTYPE html>
<html lang="en">
<head>


    <script src="cm.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/lib/codemirror.css">
    <script src="codemirror-3.1/lib/codemirror.js"></script>
    <script src="codemirror-3.1/addon/hint/show-hint.js"></script>
    <script src="codemirror-3.1/mode/xml/xml.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/addon/hint/show-hint.css">
    <script src="codemirror-3.1/addon/hint/javascript-hint.js"></script>
    <script src="codemirror-3.1/mode/javascript/javascript.js"></script>
    <script src="codemirror-3.1/addon/fold/foldcode.js"></script>


  	<title>Performance</title>
  	<meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script><script src="js/script.js"></script>
    


</head>
<body>

<!-- PRO Framework Panel Begin -->
<?php include 'head.html'; ?>
<!-- PRO Framework Panel End -->
<div class="bg-main">
<!--==============================header=================================-->
<!--==============================header=================================-->
	<header>
		
	</header>
<!--==============================section=================================-->
<!--==============================section=================================-->

	<div class="container_24">
<!-- Structure Begin -->

<!-- Layouts Begin -->
	<div class="wrapper"><div class="grid_24"><h2 class="title">Single D Configs</h2></div></div>
	</div>
	<div class="tabs tabs1">
		<div class="wrapper">
			<ul class="layouts-menu">
				<li class="layout0"><a href=""><div class="grid-box normaltip aligncenter" title="30px">CEF</div></a></li>
				<li class="layout1"><a href=""><div class="grid-box normaltip aligncenter" title="30px">NBAR</div></a></li>
				<li class="layout2"><a href=""><div class="grid-box normaltip aligncenter" title="30px">NAT</div></a></li>
				<li class="layout3"><a href=""><div class="grid-box normaltip aligncenter" title="30px">AVC_310_A</div></a></li>
				<li class="layout4"><a href=""><div class="grid-box normaltip aligncenter" title="30px">AVC_310_B</div></a></li>
				<li class="layout5"><a href=""><div class="grid-box normaltip aligncenter" title="30px">AVC_310_C</div></a></li>
				<li class="layout6"><a href=""><div class="grid-box normaltip aligncenter" title="30px">CRYPTO</div></a></li>
			</ul>
		</div>
		<div class="wrapper">
			<div class="tab-content">
				<div class="container_24">
					<div class="wrapper"><div class="grid_24"><h3>CEF</h3></div></div>
						<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
						ip cef
						ip routing
						default interface $uut_data(uut,CLIENT1)
					interface $uut_data(uut,CLIENT1)
							ip address 21.0.0.1 255.255.255.0 
							no shutdown
						default interface $uut_data(uut,SERVER1)
						interface $uut_data(uut,SERVER1)
							ip address 22.0.0.1 255.255.255.0 
							no shutdown
						default interface $uut_data(uut,CLIENT2)
					interface $uut_data(uut,CLIENT2)
							ip address 20.0.0.1 255.255.255.0 
							no shutdown
						default interface $uut_data(uut,SERVER2)
						interface $uut_data(uut,SERVER2)
							ip address 23.0.0.1 255.255.255.0 
							no shutdown
						</span>
						</div>
					</div>		
				</div>	
			</div>
		</div>
		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>NBAR</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
				default interface $uut_data(uut,CLIENT1)
			interface $uut_data(uut,CLIENT1)
					ip address 21.0.0.1 255.255.255.0 
					no shutdown
				default interface $uut_data(uut,SERVER1)
				interface $uut_data(uut,SERVER1)
				ip nbar protocol-discovery
					ip address 22.0.0.1 255.255.255.0 
					no shutdown
				default interface $uut_data(uut,CLIENT2)
			interface $uut_data(uut,CLIENT2)
					ip address 20.0.0.1 255.255.255.0 
					no shutdown
				default interface $uut_data(uut,SERVER2)
				interface $uut_data(uut,SERVER2)
				ip nbar protocol-discovery
					ip address 23.0.0.1 255.255.255.0 
					no shutdown
					</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>
		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>NAT</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
!
ip nat translation max-entries 300000
access-list 1 permit 21.0.0.0 0.255.255.255
access-list 2 permit 20.0.0.0 0.255.255.255
ip nat inside source list 1 interface  $uut_data(uut,SERVER1) overload
ip nat inside source list 2 interface  $uut_data(uut,SERVER2) overload
ip nat translation timeout 120
ip nat translation dns-timeout 1
ip nat translation finrst-timeout 1
!
!
	default interface $uut_data(uut,CLIENT1)
    interface $uut_data(uut,CLIENT1)
		ip address 21.0.0.1 255.255.255.0 
		ip nat outside
		no shutdown
	default interface $uut_data(uut,SERVER1)
	interface $uut_data(uut,SERVER1)
		ip address 22.0.0.1 255.255.255.0 
		ip nat outside
		no shutdown
	default interface $uut_data(uut,CLIENT2)
    interface $uut_data(uut,CLIENT2)
		ip address 20.0.0.1 255.255.255.0 
		ip nat inside
		no shutdown
	default interface $uut_data(uut,SERVER2)
	interface $uut_data(uut,SERVER2)
		ip address 23.0.0.1 255.255.255.0 
		ip nat inside
		no shutdown
					</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>
		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>AVC_310_A</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
			! AVC 310 A
			class-map match-any ORACLE
			match protocol ora-srv
			match protocol ncube-lm
			class-map match-any HTTP
			match protocol http
			class-map match-any EMAIL
			match protocol attribute category email 
			class-map match-any CITRIX
			match protocol citrix
			class-map match-any HTTPS
			match protocol secure-http
			match protocol ssl
			class-map match-any VOICE
			match protocol rtp
			class-map match-any DNS
			match protocol attribute sub-category naming-services
			
			policy-map QOS_LAN
			class VOICE
			set ip dscp ef
			class HTTP
			set dscp cs4
			class HTTPS
			set dscp cs2
			class ORACLE
			set dscp af11
			class CITRIX
			set ip dscp af21
			class EMAIL
			set ip dscp af31
			class DNS
			set ip dscp default
			
			class-map match-any VOIX
			match dscp ef 
			class-map match-any DATA1
			match dscp cs4 
			match dscp cs2 
			class-map match-any DATA2
			match dscp af11 
			class-map match-any DATA3
			match dscp af21 
			match dscp af31 
			
			policy-map QOS_WAN
			class VOIX
			priority 
			police rate percent 28
			class DATA1
			bandwidth remaining percent 59
			random-detect dscp-based
			fair-queue  
			class DATA2
			bandwidth remaining percent 3 
			random-detect dscp-based
			fair-queue  
			class DATA3
			bandwidth remaining percent 7
			random-detect dscp-based
			fair-queue  
			class class-default
			bandwidth remaining percent 3
			random-detect dscp-based
			fair-queue  
			
			policy-map POLICY_WAN
			class class-default
			shape average 1000000000
			service-policy QOS_WAN
						 
	default interface $uut_data(uut,CLIENT1)
    interface $uut_data(uut,CLIENT1)
		ip address 21.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER1)
	interface $uut_data(uut,SERVER1)
		ip address 22.0.0.1 255.255.255.0 
		service-policy output POLICY_WAN
		no shutdown
	default interface $uut_data(uut,CLIENT2)
    interface $uut_data(uut,CLIENT2)
		ip address 20.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER2)
	interface $uut_data(uut,SERVER2)
		ip address 23.0.0.1 255.255.255.0 
		service-policy output POLICY_WAN
		no shutdown
					</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>
		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>AVC_310_B</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
! AVC 310 B
performance monitor context my-visibility profile application-experience
  exporter destination 22.0.0.2 source $uut_data(uut,SERVER1) transport udp port 2055 
              traffic-monitor conversation-traffic-stats ipv4
              traffic-monitor url ipv4
              traffic-monitor application-traffic-stats


			class-map match-any ORACLE
			match protocol ora-srv
			match protocol ncube-lm
			class-map match-any HTTP
			match protocol http
			class-map match-any EMAIL
			match protocol attribute category email 
			class-map match-any CITRIX
			match protocol citrix
			class-map match-any HTTPS
			match protocol secure-http
			match protocol ssl
			class-map match-any VOICE
			match protocol rtp
			class-map match-any DNS
			match protocol attribute sub-category naming-services
			
			policy-map QOS_LAN
			class VOICE
			set ip dscp ef
			class HTTP
			set dscp cs4
			class HTTPS
			set dscp cs2
			class ORACLE
			set dscp af11
			class CITRIX
			set ip dscp af21
			class EMAIL
			set ip dscp af31
			class DNS
			set ip dscp default
			
			class-map match-any VOIX
			match dscp ef 
			class-map match-any DATA1
			match dscp cs4 
			match dscp cs2 
			class-map match-any DATA2
			match dscp af11 
			class-map match-any DATA3
			match dscp af21 
			match dscp af31 
			
			policy-map QOS_WAN
			class VOIX
			priority 
			police rate percent 28
			class DATA1
			bandwidth remaining percent 59
			random-detect dscp-based
			fair-queue  
			class DATA2
			bandwidth remaining percent 3 
			random-detect dscp-based
			fair-queue  
			class DATA3
			bandwidth remaining percent 7
			random-detect dscp-based
			fair-queue  
			class class-default
			bandwidth remaining percent 3
			random-detect dscp-based
			fair-queue  
			
			policy-map POLICY_WAN
			class class-default
			shape average 1000000000
			service-policy QOS_WAN
						 
	default interface $uut_data(uut,CLIENT1)
    interface $uut_data(uut,CLIENT1)
		ip address 21.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER1)
	interface $uut_data(uut,SERVER1)
		ip address 22.0.0.1 255.255.255.0 
		performance monitor context my-visibility
		service-policy output POLICY_WAN
		no shutdown
	default interface $uut_data(uut,CLIENT2)
    interface $uut_data(uut,CLIENT2)
		ip address 20.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER2)
	interface $uut_data(uut,SERVER2)
		ip address 23.0.0.1 255.255.255.0 
		performance monitor context my-visibility
		service-policy output POLICY_WAN
		no shutdown
					</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>

		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>AVC_310_C</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
! AVC 310 C

 
			performance monitor context my-visibility profile application-experience
			   exporter destination 22.0.0.2 source $uut_data(uut,SERVER1) transport udp port 2055 
					  traffic-monitor application-response-time ipv4
					  traffic-monitor conversation-traffic-stats ipv4
					  traffic-monitor url ipv4
					  traffic-monitor media ipv4
					  traffic-monitor application-traffic-stats
		
		
		class-map match-any ORACLE
		match protocol ora-srv
		match protocol ncube-lm
		class-map match-any HTTP
		match protocol http
		class-map match-any EMAIL
		match protocol attribute category email 
		class-map match-any CITRIX
		match protocol citrix
		class-map match-any HTTPS
		match protocol secure-http
		match protocol ssl
		class-map match-any VOICE
		match protocol rtp
		class-map match-any DNS
		match protocol attribute sub-category naming-services
		
		policy-map QOS_LAN
		class VOICE
		set ip dscp ef
		class HTTP
		set dscp cs4
		class HTTPS
		set dscp cs2
		class ORACLE
		set dscp af11
		class CITRIX
		set ip dscp af21
		class EMAIL
		set ip dscp af31
		class DNS
		set ip dscp default
		
		class-map match-any VOIX
		match dscp ef 
		class-map match-any DATA1
		match dscp cs4 
		match dscp cs2 
		class-map match-any DATA2
		match dscp af11 
		class-map match-any DATA3
		match dscp af21 
		match dscp af31 
		
		policy-map QOS_WAN
		class VOIX
		priority 
		police rate percent 28
		class DATA1
		bandwidth remaining percent 59
		random-detect dscp-based
		fair-queue  
		class DATA2
		bandwidth remaining percent 3 
		random-detect dscp-based
		fair-queue  
		class DATA3
		bandwidth remaining percent 7
		random-detect dscp-based
		fair-queue  
		class class-default
		bandwidth remaining percent 3
		random-detect dscp-based
		fair-queue  
		
		policy-map POLICY_WAN
		class class-default
		shape average 1000000000
		service-policy QOS_WAN
						 
	default interface $uut_data(uut,CLIENT1)
    interface $uut_data(uut,CLIENT1)
		ip address 21.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER1)
	interface $uut_data(uut,SERVER1)
		ip address 22.0.0.1 255.255.255.0 
		performance monitor context my-visibility
		service-policy output POLICY_WAN
		no shutdown
	default interface $uut_data(uut,CLIENT2)
    interface $uut_data(uut,CLIENT2)
		ip address 20.0.0.1 255.255.255.0 
		service-policy input QOS_LAN
		no shutdown
	default interface $uut_data(uut,SERVER2)
	interface $uut_data(uut,SERVER2)
		ip address 23.0.0.1 255.255.255.0 
		performance monitor context my-visibility
		service-policy output POLICY_WAN
		no shutdown
					</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>



		<div class="wrapper">
		<div class="tab-content">
			<div class="container_24">
				<div class="wrapper"><div class="grid_24"><h3>CRYPTO</h3></div></div>
					<div class="grid-row2"><div class="wrapper"><div class="grid_24 grid-box2 normaltip" title="950px"><span style="white-space: pre-line">
! CRYPTO
! UUT


	default interface $uut_data(uut,CLIENT1)
	default interface $uut_data(uut,CLIENT2)
	default interface $uut_data(uut,WAN1)
	default interface $uut_data(uut,WAN2)
					! CONFIGURE CRYPTO PEER
						crypto isakmp policy 1
                		 lifetime 86400
                		 encr aes 256
                		 authentication pre-share
                		crypto isakmp key cisco address 192.168.0.0 255.255.0.0
						crypto ipsec security-association lifetime kilobytes disable
                        crypto ipsec security-association lifetime seconds 86400
                		crypto ipsec transform-set uni-perf esp-aes 256 esp-sha-hmac
						!
                		crypto ipsec profile vti-1
                 		set transform-set uni-perf
                 		set pfs group2
                 		set security-association lifetime seconds 86400
                 		set security-association lifetime kilobytes disable
						!
                		crypto ipsec profile vti-2
                 		set transform-set uni-perf
                 		set pfs group2
                 		set security-association lifetime seconds 86400
                 		set security-association lifetime kilobytes disable
						!
                		interface loopback 1
                 		ip address 192.168.1.1 255.255.255.255
                 		load-interval 30
                 		no keepalive
                 		no shutdown
                 		!
                		interface loopback 2
                 		ip address 192.168.2.2 255.255.255.255
                 		load-interval 30
                 		no keepalive
                 		no shutdown
                 		!
                		interface tunnel 1
                 		ip unnumbered $uut_data(uut,WAN1)
						bandwidth 1000000
                 		tunnel source loopback 1
                 		tunnel destination 192.168.3.3
                 		tunnel mode ipsec IPV4
                 		tunnel protection ipsec profile vti-1
                 		load-interval 30
                 		ip virtual-reassembly
                 		no keepalive
                 		no shutdown
                 		!
                		interface tunnel 2
                 		ip unnumbered $uut_data(uut,WAN2)
						bandwidth 1000000
                 		tunnel source loopback 2
                 		tunnel destination 192.168.4.4
                 		tunnel mode ipsec IPV4
                 		tunnel protection ipsec profile vti-2
                 		load-interval 30
                 		ip virtual-reassembly
                 		no keepalive
                 		no shutdown
                 		!
						ip route 22.0.0.0 255.0.0.0 tunnel 1
						ip route 23.0.0.0 255.0.0.0 tunnel 2
                 		!
                		ip route 192.168.3.3 255.255.255.255 $uut_data(uut,WAN1)
                		ip route 192.168.4.4 255.255.255.255 $uut_data(uut,WAN2)
						interface $uut_data(uut,CLIENT1)
							ip address 21.0.0.1 255.255.255.0 
							ip tcp adjust-mss 1340
							no shutdown
						!
						interface $uut_data(uut,CLIENT2)
							ip address 20.0.0.1 255.255.255.0 
							ip tcp adjust-mss 1340
							no shutdown
						!
						!
						! INTERFACES THAT CONNECT TO PEER
						!
						interface $uut_data(uut,WAN1)
							ip address 24.0.0.1 255.255.255.0 
							no shutdown
						interface $uut_data(uut,WAN2)
							ip address 25.0.0.1 255.255.255.0 
							no shutdown
						!
!
!
!!!!!!!!!!
! PEER
!!!!!!!!!!

 !
				! SET DEFAULTS
				default interface $uut_data(uut2,SERVER1)
				default interface $uut_data(uut2,SERVER2)
				default interface $uut_data(uut2,WAN1)
				default interface $uut_data(uut2,WAN2)
				!
				! CONFIGURE CRYPTO PEER
						crypto isakmp policy 1
                		 lifetime 86400
                		 encr aes 256
                		 authentication pre-share
                		crypto isakmp key cisco address 192.168.0.0 255.255.0.0
						crypto ipsec security-association lifetime kilobytes disable
                        crypto ipsec security-association lifetime seconds 86400
                		crypto ipsec transform-set uni-perf esp-aes 256 esp-sha-hmac
						!
                		crypto ipsec profile vti-1
                 		set transform-set uni-perf
                 		set pfs group2
                 		set security-association lifetime seconds 86400
                 		set security-association lifetime kilobytes disable
						!
                		crypto ipsec profile vti-2
                 		set transform-set uni-perf
                 		set pfs group2
                 		set security-association lifetime seconds 86400
                 		set security-association lifetime kilobytes disable
						!
                		interface loopback 1
                 		ip address 192.168.3.3 255.255.255.255
                 		load-interval 30
                 		no keepalive
                 		no shutdown
                 		!
                		interface loopback 2
                 		ip address 192.168.4.4 255.255.255.255
                 		load-interval 30
                 		no keepalive
                 		no shutdown
                 		!
                		interface tunnel 1
                 		ip unnumbered $uut_data(uut2,WAN1)
						bandwidth 1000000
                 		tunnel source loopback 1
                 		tunnel destination 192.168.1.1
                 		tunnel mode ipsec IPV4
                 		tunnel protection ipsec profile vti-1
                 		load-interval 30
                 		ip virtual-reassembly
                 		no keepalive
                 		no shutdown
                 		!
                		interface tunnel 2
                 		ip unnumbered $uut_data(uut2,WAN2)
						bandwidth 1000000
                 		tunnel source loopback 2
                 		tunnel destination 192.168.2.2
                 		tunnel mode ipsec IPV4
                 		tunnel protection ipsec profile vti-2
                 		load-interval 30
                 		ip virtual-reassembly
                 		no keepalive
                 		no shutdown
                 		!
						ip route 20.0.0.0 255.0.0.0 tunnel 1
						ip route 21.0.0.0 255.0.0.0 tunnel 2
                 		!
                		ip route 192.168.1.1 255.255.255.255 $uut_data(uut2,WAN1)
                		ip route 192.168.2.2 255.255.255.255 $uut_data(uut2,WAN2)
	!
    ! INTERFACES THAT CONNECT TO AVALANCHE
    !
    interface $uut_data(uut2,SERVER1)
		ip address 22.0.0.1 255.255.255.0 
		no shutdown
	!
	interface $uut_data(uut2,SERVER2)
		ip address 23.0.0.1 255.255.255.0 
		no shutdown
	!
	!
    ! INTERFACES THAT CONNECT TO UUT
    !
	interface $uut_data(uut2,WAN1)
		ip address 24.0.0.2 255.255.255.0 
		no shutdown
	!
    interface $uut_data(uut2,WAN2)
		ip address 25.0.0.2 255.255.255.0 
		no shutdown

				</span>
					</div>
				</div>		
			</div>	
		</div>
		</div>
<!-- Right Sidebar End -->
			</div>
		</div>
	</div>
<!-- Layouts End -->


</div>
</div>



</body>
</html> 