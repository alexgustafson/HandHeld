//
//  HHTemplateModel.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"

@class SqLiteDatabaseManager;

@interface HHTemplateModel : NSObject
{
    NSNumber *id;
    NSString *name;
    BOOL isComposite;
    
    NSArray* fields;
    SqLiteDatabaseManager* _dbManager;
}

@property (nonatomic, retain) NSNumber *id;
@property (nonatomic, retain)   NSString *name;
@property (nonatomic) BOOL isComposite;
@property (nonatomic, retain) NSArray* fields;

- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andTemplateArray:(NSArray *)templateArray;


@end
