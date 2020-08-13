query 
{ 
    documentsByFolder(folder_id: "$id", limit: 60, page: 1) 
    { 
        total data 
        { 
            id name created_at files 
            {
                original signed 
            } 
            signatures 
            { 
                public_id name email action 
                { 
                    name 
                } 
                viewed 
                { 
                    created_at 
                } 
                signed
                { 
                    created_at 
                } 
                rejected 
                { 
                    created_at 
                } 
            } 
        } 
    } 
}