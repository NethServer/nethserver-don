Name: nethserver-don
Version: 0.0.1
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
%dir %{_nseventsdir}/%{name}-update

%changelog
* Mon Nov 13 2017 Giacomo Sanchietti <giacomo.sanchietti@nethesis.it> - 0.0.1-1
- First beta release


