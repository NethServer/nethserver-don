Name: nethserver-don
Version: 0.0.1
Release: 1%{?dist}
Summary: Don is the client for Windmill remote support system

License: GPLv3
URL: https://github.com/nethesis/windmill
Source0: https://github.com/nethesis/windmill/archive/master.tar.gz

BuildRequires:
Requires: openvpn, openssh-server

%description
Don is the client for Windmill remote support system.
It established a OpenVPN tunnel and open an ad-hoc OpenSSH server instance

%prep
%setup -q


%build
%configure
#make %{?_smp_mflags}


%install
%make_install


%files
%doc



%changelog

