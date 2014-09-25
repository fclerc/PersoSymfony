<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Personalize your MOOC experience</title>
        
         <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/css/main.css') ?>">
         <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/css/bootstrap.min.css') ?>">
        
        
        
    </head>
    <body>
        <div class="container">
            <h1 class="toTranslate">fileChoice.h1</h1>
            <p class="toTranslate">fileChoice.explanations</p>
            
            <a href="manuals/manuel_utilisateur.pdf">Manuel Utilisateur de l'application</a>
            <br/>
            <a href="manuals/rapport.pdf">Rapport détaillant le modèle exploité</a></p>.
            <hr/>
            <a href="statistics.php" class="toTranslate btn btn-primary" id="statsLink">fileChoice.statistics.link</a><br/>
            <a href="sequence_association.php" class="toTranslate btn btn-primary" id="associationsLink">fileChoice.association.link</a>
            
            
    
            <div id="sectionsContainer"/>
        </div>
            
            
            
            
        <script src="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/js/jquery-2.1.1.js')?>"></script>
        <script src="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/translation/translate.js')?>"></script>
        <script src="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/translation/icu.js') ?>"></script>
         
        <?php
         
        $lang = $view['request']->getLocale(); 
         
        $data = json_decode(file_get_contents($publicPath.'resources/filePageData.json'));
        
        //adding for each section the list of files available (for example the list of strategy files in data/teacher/strategies)
        $sections = $data->sections;
        $files = array();
        foreach($sections as $section){
                $path = $data->path->$section;
                $sectionFiles = scandir($publicPath.$path);
                $files[$section] = $sectionFiles;
        }
        $data->files = $files;
        
        $publicPathJs = $str = str_replace('\\', '/', $publicPath);
        
        $translationPath = $publicPath.'translation/'.$lang.'.json';
        $translationFile = json_decode(file_get_contents($translationPath));
        
        ?>
         
        <script>
         
            $(function(){
                    var translationData = <?php echo json_encode($translationFile); ?>;              
                            _.setTranslation(translationData);
                                    //translating the already displayed content
                        $('#fileRemovedSuccess, .container h1, #languageChoice span, p, .toTranslate').each(function(){
                            $(this).text(_($(this).text()));
                        });


                        //passing the data to js
                                    var data = <?php echo json_encode($data); ?>;
                                    var sectionsContainer =$('#sectionsContainer');

                        //for each section, display informations and form to select file
                                    $(data['sections']).each(function(i, section){
                                            var sectionContainer = $('<div>').addClass('section');

                            //title and instruction
                                            $(sectionContainer).append($('<h2>').append(_(data['h2'][section])));
                                            $(sectionContainer).append($('<p>').append(_(data['instruction'][section])));

                            //form to select file
                                            var form = $('<form>').attr('action', data['interface'][section]).attr('method', 'POST');
                            //creating the select input, and filling with list of files
                                            var fileSelect = $('<select>').addClass('form-control').attr('name', 'file');
                                            $(data['files'][section]).each(function(id, file){
                                                    if(file != '.' && file !='..' && file!='empty.xml'){
                                                            $(fileSelect).append($('<option>').append(file));
                                                    }
                                            });

                            //transmission of the data to the interface page through hidden inputs
                                            var pathForm = $('<input>').attr('type', 'hidden').attr('name', 'path').attr('value', data['path'][section]);
                                            var sectionForm = $('<input>').attr('type', 'hidden').attr('name', 'section').attr('value', section);
                                            var scalesForm = $('<input>').attr('type', 'hidden').attr('name', 'scales').attr('value', data['scales'][section]);
                                            var schemaForm = $('<input>').attr('type', 'hidden').attr('name', 'schema').attr('value', data['schema'][section]);
                                            var actionForm = $('<input>').attr('type', 'hidden').attr('name', 'action').attr('value', data['interface'][section]);

                            //buttons to open, create, duplicate and delete file
                                            var fileOpener = $('<input>').attr('type', 'submit').attr('Value', _('Open file')).addClass('btn btn-success').attr('name', 'fileOpener');
                                            var fileCreator = $('<input>').attr('type', 'submit').attr('Value', _('Create new file')).addClass('btn btn-info').attr('name', 'fileCreator');
                                            var fileDuplicator = $('<input>').attr('type', 'submit').attr('Value', _('Duplicate file')).addClass('btn btn-primary').attr('name', 'fileDuplicator');
                                            var fileDeleter = $('<input>').attr('type', 'submit').attr('Value', _('Delete file')).addClass('btn btn-danger').attr('name', 'fileDeleter');

                            //changing the action page if click on 'create' or 'delete' button : treatment by the fileHandler is required
                            $(fileCreator).add(fileDuplicator).click(function(){
                                $(this).closest('form').attr('action', 'phphelpers/fileHandler.php');
                            });
                            $(fileDeleter).click(function(event){
                                //asking confirmation to the user for deletion
                                if(confirm(_('fileChoice.delete.confirm'))){
                                    $(this).closest('form').attr('action', 'phphelpers/fileHandler.php');
                                }
                                else{
                                    event.preventDefault();
                                }
                            });

                            //if strategy section test : this is not the only file select to display, thus display a label to explain what the first select is
                            if(section == 'strategyTest'){
                                $(form).append($('<label>').append(_('Chose your strategy')).attr('for', 'file'));
                            }

                            //adding all elements to the form
                                            $(form).append(fileSelect).append(pathForm).append(sectionForm).append(schemaForm).append(scalesForm).append(actionForm);

                            //if strategy section : display the other select file, to chose a profile, a liveContext and sequenceContext
                            if(section == 'strategyTest'){
                                var otherFiles = ['profile', 'liveContext', 'sequenceContext'];
                                //for each type of file, display the select
                                $(otherFiles).each(function(id, name){
                                    var label = $('<label>').append(_(name)).attr('for', name+'file');
                                    var fileSelect = $('<select>').addClass('form-control').attr('name', name+'file');
                                    $(data['files'][name]).each(function(id, file){
                                        if(file != '.' && file !='..' && file!='empty.xml'){
                                            $(fileSelect).append($('<option>').append(file));
                                        }
                                    });
                                    //passing to the interface the path to the folder
                                    var pathForm = $('<input>').attr('type', 'hidden').attr('name', name+'path').attr('value', data['path'][name]);

                                    $(form).append(label).append(fileSelect).append(pathForm);
                                });
                            }

                            //adding buttons (in case of strategy test, buttons other than open make no sense)
                                            $(form).append(fileOpener);
                            if(section != 'strategyTest'){
                                $(form).append(fileCreator).append(fileDuplicator).append(fileDeleter);
                                            }
                                            $(sectionContainer).append(form);


                                            //Adding generated html to the sectionsContainer
                                            if(i%2 === 0){//new row
                                                    $(sectionsContainer).append($('<div>').addClass('row').append(sectionContainer));
                                            }
                                            else{//append last row
                                                    $(sectionsContainer).children('div').last().append(sectionContainer);
                                            }
                                    });

		});//jQuery
         
         
         
         
         
         
         
         
         
         
        </script>
    </body>
    
</html>
