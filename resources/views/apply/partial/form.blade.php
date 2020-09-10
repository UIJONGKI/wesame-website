<p>
    <label for="name">
        Name (Required)
    </label>
    <input type="text" id="apply-name" name="name" value="{{$applier->name}}" required>
    {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="email">
        E-mail
    </label>
    <input type="text" id="apply-email" name="email" value="{{$applier->email}}" required>
    {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
</p>

<p>
    <label for="context">
        Reason For Application (Required)
    </label>
    <textarea id="context" cols="100" rows="10" name="context" required></textarea>
    {!! $errors->first('context', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="apply-portfolio">
        Your Additional Portfolio
    </label>
    <input type="file" id="apply-portfolio" name="files[]"/>
</p>
