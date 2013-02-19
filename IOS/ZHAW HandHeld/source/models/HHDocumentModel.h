//
//  HHDocumentModel.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"

@class SqLiteDatabaseManager, HHArticleModel;
@interface HHDocumentModel : NSObject
{
    NSNumber* id;
    NSString *name;
    NSString *last_publication_date;
    NSNumber *version;
    
    HHArticleModel *startArticle;
    
    SqLiteDatabaseManager *_dbManager;
    
}

@property (nonatomic, retain) NSNumber *id;
@property (nonatomic, retain) NSString *name;
@property (nonatomic, retain) NSString *last_publication_date;
@property (nonatomic, retain) NSNumber *version;
@property (nonatomic, retain) HHArticleModel *startArticle;


-(id)initWithDBManager:(SqLiteDatabaseManager *)dbManager;
- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andDocumentArray:(NSArray *)documentArray;



@end
