gd_v='gooddata-cli-1.2.39-BETA'
mkdir -p /opt/GD/template
mkdir /opt/GD/ruby
cd /opt/
wget https://github.com/downloads/gooddata/GoodData-CL/$gd_v.tar.gz
tar -zxf $gd_v.tar.gz
mv $gd_v/* GD/
rmdir $gd_v
rm $gd_v.tar.gz

echo "Setting up user hierarchy"

cd GD/ruby/
git clone git://github.com/fluke777/gooddata-ruby.git
git clone git://github.com/fluke777/user_hierarchies.git
git clone git://github.com/fluke777/variable_uploader_template.git
git clone git://github.com/fluke777/variable_uploader.git
cd variable_uploader_template
bundle install
