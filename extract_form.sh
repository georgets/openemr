 mysqldump -p'openemr' --skip-extended-insert -c kardiagnosis -t layout_options -w "form_id='HIS'" |sed 's/INSERT INTO/REPLACE/'
