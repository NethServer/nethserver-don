Name: nethserver-don
Version: 0.3.0
Release: 1%{?dist}
Summary: Don is the client for Windmill remote support system
BuildArch: noarch

License: GPLv3
URL: https://github.com/nethesis/windmill
Source: %{name}-%{version}.tar.gz

BuildRequires: nethserver-devtools
Requires: openvpn, openssh-server, don

%description
Don is the client for Windmill remote support system.
It established a OpenVPN tunnel and open an ad-hoc OpenSSH server instance

%prep
%setup -q


%build
%{makedocs}
perl createlinks


%install
rm -rf %{buildroot}
(cd root   ; find . -depth -print | cpio -dump %{buildroot})
%{genfilelist} %{buildroot} > e-smith-%{version}-filelist


%files -f e-smith-%{version}-filelist
%defattr(-,root,root)
%dir /etc/e-smith/events/%{name}-update

%changelog
* Tue Feb 06 2018 Giacomo Sanchietti <giacomo.sanchietti@nethesis.it> - 0.3.0-1
- UI: always validate parameters on stop - nethserver-don#7

* Tue Jan 16 2018 Giacomo Sanchietti <giacomo.sanchietti@nethesis.it> - 0.2.0-1
- UI: fix copy&paste for FF 57 - nethserver-don#6
- firewall: open port 981 if shorewall is stopped - nethserver-don#5

* Mon Dec 04 2017 Giacomo Sanchietti <giacomo.sanchietti@nethesis.it> - 0.1.0-1
- First nethserver-don stable release

* Mon Nov 13 2017 Giacomo Sanchietti <giacomo.sanchietti@nethesis.it> - 0.0.1-1
- First beta release


