var mysettings = new WYSIWYG.Settings();
mysettings.Height = "200px";
mysettings.ImagesDir = "lib/openwysiwyg/images/";
mysettings.PopupsDir = "lib/openwysiwyg/popups/";
mysettings.CSSFile = "lib/openwysiwyg/styles/wysiwyg.css";
mysettings.removeToolbarElement("insertimage");
WYSIWYG.attach('message', mysettings);			
