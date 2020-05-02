import os

directory = '/var/www/public/{projectname}/wp-content/themes'
find = "fadboilerplatetheme"
find2 = "fadboilerplate"
replace = "{projectname}"

# walk through the directory from bottom up
for root, dirs, filenames in os.walk(directory):
    print dirs
    dirs[:] = [d for d in dirs if d != '.git']  # skip .git dirs
    for filename in filenames:
        path1 = os.path.join(root, filename)
        if filename != "renameall.py":  # name of the script. Don't change yourself!

            # search and replace within files themselves
            filepath = os.path.join(root, filename)
            with open(filepath) as f:
                    fileContents = f.read()
                    newContents = fileContents.replace(find, replace)
                    if (newContents != fileContents):
                        with open(filepath, "w") as f:
                            f.write(newContents)

            # rename files (ignoring file extensions)
            filename_zero, extension = os.path.splitext(filename)
            if find in filename_zero:
                path2 = os.path.join(root, filename_zero.replace(find, replace) + extension)
                os.rename(path1, path2)
                #print "file: " + path1 + "  renamed to: " + path2

    for thedir in dirs:
        if find in thedir:
            newdir = thedir.replace(find, replace)
            path1 = os.path.join(root, thedir)
            path2 = os.path.join(root, newdir)
            os.rename(path1, path2)
            dirs = [d.replace(thedir, newdir) for d in dirs]  # update the dirs list
            #print "dir: " + path1 + "  renamed to: " + path2

# walk through the directory from bottom up
for root, dirs, filenames in os.walk(directory):
    print dirs
    dirs[:] = [d for d in dirs if d != '.git']  # skip .git dirs
    for filename in filenames:
        path1 = os.path.join(root, filename)
        if filename != "renameall.py":  # name of the script. Don't change yourself!

            # search and replace within files themselves
            filepath = os.path.join(root, filename)
            with open(filepath) as f:
                    fileContents = f.read()
                    newContents = fileContents.replace(find2, replace)
                    if (newContents != fileContents):
                        with open(filepath, "w") as f:
                            f.write(newContents)

            # rename files (ignoring file extensions)
            filename_zero, extension = os.path.splitext(filename)
            if find2 in filename_zero:
                path2 = os.path.join(root, filename_zero.replace(find2, replace) + extension)
                os.rename(path1, path2)
                #print "file: " + path1 + "  renamed to: " + path2

    for thedir in dirs:
        if find2 in thedir:
            newdir = thedir.replace(find2, replace)
            path1 = os.path.join(root, thedir)
            path2 = os.path.join(root, newdir)
            os.rename(path1, path2)
            dirs = [d.replace(thedir, newdir) for d in dirs]  # update the dirs list
            #print "dir: " + path1 + "  renamed to: " + path2
