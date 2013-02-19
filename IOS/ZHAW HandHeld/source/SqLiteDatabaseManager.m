//
//  SqLiteDatabaseFileManager.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "SqLiteDatabaseManager.h"

@implementation SqLiteDatabaseManager
@synthesize open, handheldDB;

+ (BOOL)SqLiteDBFileIsDownloaded
{
    
    NSFileManager *fileManager = [[NSFileManager alloc] init];    
    NSString *filePath = [SqLiteDatabaseManager pathToDB];
    bool isAvailable = [fileManager fileExistsAtPath:filePath];
    FMDatabase *handheldDB = [FMDatabase databaseWithPath:filePath];
    if (![handheldDB open]) {
        isAvailable = nil;
    }
    [fileManager release];
    return isAvailable;
}

+ (NSString *)pathToDB
{
    NSString *fileName = @"handheld.db";
    NSArray *pathArr = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *folder = [pathArr objectAtIndex:0];
    NSString *filePath = [folder stringByAppendingPathComponent:fileName];
    return filePath;

}

- (id)initWithPath:(NSString *)dbpath
{
    self = [super init];
    if (self) {

        [self setHandheldDB:[FMDatabase databaseWithPath:dbpath]];
        if (![handheldDB open]) {
            return nil;
        }
    }
    return self;
}

- (NSMutableArray *)getListOfFilesFromDB
{
    if (![handheldDB open]) {
        return nil;
    }
    
        NSMutableArray *fileList = [[NSMutableArray alloc] init];
        FMResultSet *s = [handheldDB executeQuery:@"SELECT * FROM files" ];

        while ([s next]) {

            [fileList addObject:[s  stringForColumn:@"filename"]];

        }
        [s close];
        [handheldDB close];
        return [fileList autorelease];

}

-(NSArray *)getAllDocuments
{
    NSMutableArray *results = [[[NSMutableArray alloc] init] autorelease];
    if (![handheldDB open]) {
        return nil;
    }
    
    FMResultSet *s = [handheldDB executeQuery:@"SELECT * FROM document"];
    while ([s next]) {
        [results addObject:[s resultDictionary]];
    }
    [s close];
    
    return results;
}

- (NSArray *)getArticleArrayForArticleID:(NSNumber *)articleID
{
    NSMutableArray *results = [[[NSMutableArray alloc] init] autorelease];
    if (![handheldDB open]) {
        return nil;
    }
    
    FMResultSet *s = [handheldDB executeQueryWithFormat:@"SELECT * FROM article WHERE id = %d", [articleID intValue]];
    while ([s next]) {
        [results addObject:[s resultDictionary]];
    }
    [s close];
    
    return [results objectAtIndex:0];
}

- (NSArray *)getTemplateArrayForTemplateID:(NSNumber *)templateID
{
    NSMutableArray *results = [[[NSMutableArray alloc] init] autorelease];
    if (![handheldDB open]) {
        return nil;
    }
    
    FMResultSet *s = [handheldDB executeQueryWithFormat:@"SELECT * FROM template WHERE id = %d", [templateID intValue]];
    while ([s next]) {
        [results addObject:[s resultDictionary]];
    }
    [s close];
    
    return [results objectAtIndex:0];
}

- (NSArray *)getFieldsForTemplateID:(NSNumber *)templateID
{
    NSMutableArray *results = [[[NSMutableArray alloc] init] autorelease];
    if (![handheldDB open]) {
        return nil;
    }
    NSString* querry = [NSString stringWithFormat:@" SELECT f.id, f.name name, ft.id field_type_id, ft.name field_type_name, f.child_template_id FROM fields f "];
    querry = [querry stringByAppendingString:@" JOIN field_type ft ON ft.id = f.field_type_id " ];
    querry = [querry stringByAppendingFormat:@" WHERE f.template_id = %d ", [templateID intValue]];
    querry = [querry stringByAppendingString:@" ORDER BY f.order_nr " ];
    
    
    FMResultSet *s = [handheldDB executeQueryWithFormat:querry];
    while ([s next]) {
        [results addObject:[s resultDictionary]];
    }
    [s close];
    
    for (NSMutableDictionary *field in results) {
        
        if ([field valueForKey:@"child_template_key"] > 0) {
            
            [field setObject:[self getFieldsForTemplateID:[field valueForKey:@"child_tempalte_id"]] forKey:@"children"];
            
        }
    }
    
    return [results objectAtIndex:0];
}

-(NSDictionary *)getFieldForFieldID:(NSNumber *)fieldID
{
    NSMutableArray *results = [[[NSMutableArray alloc] init] autorelease];
    if (![handheldDB open]) {
        return nil;
    }
    NSString* querry = [NSString stringWithFormat:@" SELECT f.id, f.name name, ft.id field_type_id, ft.name field_type_name, f.child_template_id, f.order_nr, tp.name template_name FROM fields f "];
    querry = [querry stringByAppendingString:@" LEFT OUTER JOIN field_type ft ON ft.id = f.field_type_id " ];
    querry = [querry stringByAppendingString:@" LEFT OUTER JOIN template tp ON tp.id = f.child_template_id " ];
    querry = [querry stringByAppendingFormat:@" WHERE f.id = %d ", [fieldID intValue]];
    //NSLog(querry);
    
    FMResultSet *s = [handheldDB executeQueryWithFormat:querry];
    while ([s next]) {
        [results addObject:[s resultDictionary]];
    }
    [s close];
    
    return [results objectAtIndex:0];
}

- (HHArticleModel *)getArticleForArticleID:(NSNumber *)articleID
{
    return [[[HHArticleModel alloc] initWithDBManager:self andDocumentArray:[self getArticleArrayForArticleID:articleID]] autorelease];
}

- (NSDictionary *)parseArticleData:(NSDictionary *)data
{
    
    NSMutableDictionary* parsedData = [[NSMutableDictionary alloc] init] ;
    
    for (id key in data) {
        
        id field = [data objectForKey:key];
        
        if ([field isKindOfClass:[NSDictionary class]]) {
            //field is a template so parse data for that
            
            NSDictionary* fields = [self getFieldForFieldID:key];
            
            HHFieldModel* template = [[[HHFieldModel alloc] init] autorelease];
            [template setId:key];
            [template setChildren:[self parseArticleData:field]];
            [template setName:[fields objectForKey:@"name"]];
            [template setOrder_nr:[fields objectForKey:@"order_nr"]];
            [template setFieldType:[fields objectForKey:@"field_type_id"]];
            [template setFieldTypeName:[fields objectForKey:@"template_name" ]];
            
            [parsedData setObject:template forKey:key];
            
            
        }else{
            
            NSDictionary* fields = [self getFieldForFieldID:key];
            
            HHFieldModel* template = [[[HHFieldModel alloc] init] autorelease];
            [template setId:key];
            [template setData:field];
            [template setName:[fields objectForKey:@"name"]];
            [template setOrder_nr:[fields objectForKey:@"order_nr"]];
            [template setFieldType:[fields objectForKey:@"field_type_id"]];
            [template setFieldTypeName:[fields objectForKey:@"field_type_name" ]];

            [parsedData setObject:template forKey:key];
            
        }
    }
    
    return [parsedData autorelease];
}


@end
