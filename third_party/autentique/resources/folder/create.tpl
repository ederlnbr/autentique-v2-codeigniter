mutation CreateFolderMutation($folder: FolderInput!) 
{ 
    createFolder(folder: $folder) 
    { 
        id name type created_at 
    } 
}