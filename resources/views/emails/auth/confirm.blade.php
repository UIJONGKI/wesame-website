{{ $user->name }}님, 환영합니다. <br/>
{{ $user->name }}님께서 {{ $user->email }}을 WESAME 계정ID로 등록 하셨습니다. <br/>
아래 링크를 클릭하시고 등록하신 Email이 본인 소유임을 확인해 주세요.<br/><br/><br/>

Hello {{ $user->name }}! Welcome to WESAME! <br/>
Please Click the bottom button to verify yor ID <br/><br/><br/>

<a href="{{ route('users.confirm', $user->confirm_code) }}" style="color:#ffffff;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://account.samsung.com/accounts/v1/keya/K8JXGNOJYK6HPL4ZDEDI9PX0SCS2GLXV&amp;source=gmail&amp;ust=1507026172612000&amp;usg=AFQjCNHOXQvwXP1UMWs0nfpdAjW0UZSjqw"><b style="border:1px solid #1428a0;border-radius:5px;background:#1428a0;color:#ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight:normal;text-transform:uppercase">계정 사용하기</b></a>
