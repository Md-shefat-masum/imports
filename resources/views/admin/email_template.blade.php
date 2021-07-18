<h3>
    <a href="">FreeWorldImports Email Verification</a>
</h3>
<br>
<p>
    Please continue your registration by clicking on this link :
    <a href="https://www.freeworldimports.com/{{ $data['url'] }}">
    FREEWORLDIMPORTS SUPPLIER REGISTRATION
    </a>
</p>
<br>
<p>Thank  You</p>
<br>
<p>
Bizdev@FreeWorldImports
</p>
<p>
    <b>From:</b> <a href="mailto:support@freeworldimports.com">support@freeworldimports.com</a>
</p>
<p>
    <b>Sent:</b> {{ date("l, F j, Y, g:i a", strtotime($data['time'])) }}
</p>
<p>
    <b>To: </b>{{ $data['email'] }}
</p>
<p>
    <b> Subject:</b> FreeWorldImports Supplier Email Verification
</p>
<br>
Please continue your registration by clicking on this link :
<a href="https://www.freeworldimports.com/{{ $data['url'] }}">
    FREEWORLDIMPORTS SUPPLIER REGISTRATION
</a>
<p>or Copy this link : https://www.freeworldimports.com/{{ $data['url'] }}</p>
