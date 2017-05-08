import os

blacklist_dirs = ['includes']

shebang = "#!/usr/local/php5/bin/php-cgi\n"

def remove_shebang(path):
    with open(path, 'r+') as php_file:
        contents = php_file.read()
        if contents.startswith(shebang):
            contents = contents[len(shebang):]
            open(path, 'w').write(contents)

def remove_shebang_dir(path):
    for filename in os.listdir(path):
        full_path = '{}/{}'.format(path, filename)
        if filename.endswith('.php'):
            remove_shebang(full_path)
        elif os.path.isdir(full_path) and (filename not in blacklist_dirs):
            remove_shebang_dir(full_path)

remove_shebang_dir('src')
