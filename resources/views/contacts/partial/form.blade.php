<p>
    <label>
        Category (Required)
    </label>
    <select name="category" required/>
        <option>
            <option value="">---</option>
            <option value="Display">Display</option>
            <option value="Education">Education</option>
            <option value="Sales">Sales</option>
            <option value="Request Manufacturing">Request Manufacturing</option>
            <option value="Etc">Etc</option>
        </option>
    </select>
    {!! $errors->first('category', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="name">
        Name (Required)
    </label>
    <input type="text" id="contacts-name" name="name" required>
    {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="email">
        E-mail (Required)
    </label>
    <input type="email" id="contacts-email" name="email" required>
    {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="subject">
        Subject (Required)
    </label>
    <input type="text" id="contacts-subject" name="subject" required="">
    {!! $errors->first('subject', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label for="context">
        Context (Required)
    </label>
    <textarea id="context" name="context"></textarea>
    {!! $errors->first('context', '<span class="form-error">:message</span>') !!}
</p>
<p>
    <label>
        Upload-images
    </label>
    <input type="file" name="files[]" value="" id="files" />
    {!! $errors->first('files.0', '<span class="form-error">:message</span>') !!}
</p>
