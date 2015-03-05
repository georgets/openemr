if [[ $dbp == '' ]] ;then
   echo "you could set \$dbp to the mysql password"
   echo -n 'dbpassword :';read dbp
fi 

if [[ $dbp == '' ]] ;then
   exit
fi 


cmd="mysqldump -uopenemr -p$dbp --compact --skip-extended-insert -c openemr"

$cmd -t layout_options -w "form_id LIKE 'LBFcardio_visit'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t layout_options -w "form_id LIKE 'HIS'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "list_id LIKE 'cv_%'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "option_id LIKE 'cv_%'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "option_id LIKE 'blank'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "option_id LIKE 'Auscultation_area'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "list_id LIKE 'lbfnames'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'


$cmd -t list_options -w "list_id LIKE 'blank'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
$cmd -t list_options -w "list_id LIKE 'Auscultation_area'" |sed 's/INSERT INTO/REPLACE/' | grep -v '^/' |grep -v '^--'
