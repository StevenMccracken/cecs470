import os

blacklist_dirs = ['includes']

shebang = "#!/usr/local/php5/bin/php-cgi\n"

def add_shebang(path):
    with open(path, 'r+') as php_file:
        contents = php_file.read()
        if not contents.startswith(shebang):
            contents = shebang + contents
            php_file.seek(0)
            php_file.write(contents)


def add_shebang_dir(path):
    for filename in os.listdir(path):
        full_path = '{}/{}'.format(path, filename)
        if filename.endswith('.php'):
            add_shebang(full_path)
        elif os.path.isdir(full_path) and (filename not in blacklist_dirs):
            add_shebang_dir(full_path)

add_shebang_dir('src')
