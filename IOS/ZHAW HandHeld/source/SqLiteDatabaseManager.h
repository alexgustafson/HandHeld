//
//  SqLiteDatabaseFileManager.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "FMDatabase.h"
#import "HHDocumentModel.h"
#import "HHFieldModel.h"

@class HHArticleModel;
@interface SqLiteDatabaseManager : NSObject
{
    FMDatabase* handheldDB;
    BOOL open;
    NSString* version;
}

@property (nonatomic) BOOL open;
@property (nonatomic, retain)FMDatabase* handheldDB;

+ (BOOL)SqLiteDBFileIsDownloaded;
+ (NSString *)pathToDB;

- (id)initWithPath:(NSString *)dbpath;

- (NSMutableArray *)getListOfFilesFromDB;
- (NSArray *)getAllDocuments;
- (NSArray *)getArticleArrayForArticleID:(NSNumber *)articleID;
- (NSArray *)getTemplateArrayForTemplateID:(NSNumber *)templateID;
- (NSArray *)getFieldsForTemplateID:(NSNumber *)templateID;
- (HHArticleModel *)getArticleForArticleID:(NSNumber *)articleID;
- (NSDictionary *)parseArticleData:(NSDictionary *)data;
- (NSDictionary *)getFieldForFieldID:(NSNumber *)fieldID;

@end
