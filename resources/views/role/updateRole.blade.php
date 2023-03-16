<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
        a {
            text-decoration: none;
            color: white;
        }
        a:hover {
            text-decoration: none;
            color: white;
        }

        .group {
        position: relative;
        }

        .input {
        font-size: 16px;
        padding: 10px 10px 10px 5px;
        display: block;
        width: 200px;
        border: none;
        border-bottom: 1px solid #515151;
        background: transparent;
        }

        .input:focus {
        outline: none;
        }

        label {
        color: #999;
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 5px;
        top: 10px;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
        }

        .input:focus ~ label, .input:valid ~ label {
        top: -20px;
        font-size: 14px;
        color: #5264AE;
        }

        .bar {
        position: relative;
        display: block;
        width: 200px;
        }

        .bar:before, .bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #5264AE;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
        }

        .bar:before {
        left: 50%;
        }

        .bar:after {
        right: 50%;
        }

        .input:focus ~ .bar:before, .input:focus ~ .bar:after {
        width: 50%;
        }

        .highlight {
        position: absolute;
        height: 60%;
        width: 100px;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;
        }

        .input:focus ~ .highlight {
        animation: inputHighlighter 0.3s ease;
        }

        @keyframes inputHighlighter {
        from {
        background: #5264AE;
        }

        to {
        width: 0;
        background: transparent;
        }
        }
        .code-block {
            margin: auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
            <h1 class="text-center">Update Role</h1>
            </div>
        </div>
    </div>
    <div class="code-block">
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="modal-body">
                    <div class="group">
                        <input required="" type="text" name="roleUpdate" value="{{ $roleMembers->role }}" class="input">
                        <input required="" type="hidden" name="roleId" value="{{ $roleMembers->id }}" class="input">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Role</label>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary"><a href="/role">Cancel</a></button>
                </div>
            </div>

        </form>
    </div>